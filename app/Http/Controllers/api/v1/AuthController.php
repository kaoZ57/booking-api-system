<?php

namespace App\Http\Controllers\api\v1;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Arr;
use App\Models\Central;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\DatabaseLog;

/**
 * Class AuthController
 * @package App\Http\Controllers\api\v1
 * @group Auth
 * User Authentication
 */
class AuthController extends Controller
{
    /**
     * User Registration
     * @param UserRequest $request
     * @bodyParam  name string required The name of the user.
     * @bodyParam  email string required The email address of the user.
     * @bodyParam  password password required  Password.
     * @bodyParam password_confirmation password required Password Confirmation
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:users|min:3|max:60',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4|max:60|confirmed',
                'password_confirmation' => 'required'
            ]);
            // $validator = Validator::make($request->all(), $request->rules(), $request->messages());
            $newUser = User::create(
                array_merge($request->validated(), ['password' => Hash::make($request->password)])
            );
            if (!$newUser) {
                DatabaseLog::log_NoUser($request, 'failed');
                return $this->authResponse(301, 'failed', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            // UserCreated::dispatch($newUser); //assign the user a user role
            $newUser->assignRole(Role::find(3)); //assign the customer a user role
            new UserResource($newUser);

            DatabaseLog::log_NoUser($request, 'successfully');
            return $this->authResponse(101, 'successfully', Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            DatabaseLog::log_NoUser($request, (string) $exception->errorInfo[2]);
            return $this->authResponse(500, (string)  $exception->errorInfo[2], Response::HTTP_UNPROCESSABLE_ENTITY);
            // return $this->commonResponse(false, $exception->errorInfo[2], '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical('Something went wrong registering a new user. ERROR:' . $exception->getTraceAsString());
            DatabaseLog::log_NoUser($request, (string) $exception->getMessage());
            return $this->authResponse(500, (string)  $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
            // return $this->commonResponse(false, $exception->getMessage(), '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * User Login
     * @param Request $request
     * @bodyParam email string required Email Address
     * @bodyParam password password required Password
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'email.required' => 'Please enter your email address',
            'password.required' => 'Please enter your password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            DatabaseLog::log_NoUser($request, (string) Arr::flatten($validator->messages()->get('*')));
            return $this->bookingResponse(500, (string) Arr::flatten($validator->messages()->get('*')), 'token', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $user = User::firstWhere('email', $request->email);
            if (!$user) {
                DatabaseLog::log_NoUser($request, 'A user with the provided credentials could not be found');
                return $this->bookingResponse(404, 'A user with the provided credentials could not be found', 'token', '', Response::HTTP_EXPECTATION_FAILED);
            }
            if (!Hash::check($request->password, $user->password)) {
                DatabaseLog::log_NoUser($request, 'invalid password');
                return $this->bookingResponse(206, 'invalid password', 'token',  '', Response::HTTP_EXPECTATION_FAILED);
            }
            $data = [
                'user' => new UserResource($user),
                'accessToken' => $token = $user->createToken('crm-user')->plainTextToken //generate an access token for the user
            ];
            DatabaseLog::log_NoUser($request, 'successfully');
            return $this->bookingResponse(101, 'successfully', 'token',  $token, Response::HTTP_OK);
        } catch (QueryException $exception) {
            DatabaseLog::log_NoUser($request, (string) $exception->errorInfo[2]);
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'token', '', Response::HTTP_UNPROCESSABLE_ENTITY);
            // return $this->commonResponse(false, $exception->errorInfo[2], '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical('Something went wrong logging in the user. ERROR:' . $exception->getTraceAsString());
            DatabaseLog::log_NoUser($request, (string) $exception->getMessage());
            return $this->bookingResponse(500, $exception->getMessage(), 'token', '', Response::HTTP_INTERNAL_SERVER_ERROR);
            // return $this->commonResponse(false, $exception->getMessage(), '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * User Logout
     * @param Request $request
     * @return JsonResponse
     * @authenticated
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            if ($user->tokens()->delete()) {
                DatabaseLog::log($request, 'successfully');
                return $this->authResponse(101, 'successfully', Response::HTTP_OK);
                // return $this->commonResponse(true, 'Logout Successful', '', Response::HTTP_OK);
            }
            DatabaseLog::log($request, 'failed');
            return $this->authResponse(301, 'failed', Response::HTTP_EXPECTATION_FAILED);
            // return $this->commonResponse(false, 'Failed to logout', '', Response::HTTP_EXPECTATION_FAILED);
        } catch (Exception $exception) {
            Log::critical('Failed to perform user logout. ERROR ' . $exception->getTraceAsString());
            DatabaseLog::log($request, (string) $exception->getMessage());
            return $this->authResponse(500, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            // return $this->commonResponse(false, $exception->getMessage(), '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
