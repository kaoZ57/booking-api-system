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
    public function register(UserRequest $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), $request->rules(), $request->messages());
            if ($validator->fails()) {
                return $this->authResponse(304, (string) Arr::flatten($validator->messages()->get('*')), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $newUser = User::create(
                array_merge($request->validated(), ['password' => Hash::make($request->password)])
            );
            if (!$newUser) {
                return $this->authResponse(301, 'Registration Unsuccessful, please try again', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            // UserCreated::dispatch($newUser); //assign the user a user role
            $newUser->assignRole(Role::find(3)); //assign the customer a user role
            new UserResource($newUser);
            return $this->authResponse(201, 'Registration successful', Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return $this->authResponse(500, $exception->errorInfo[2], Response::HTTP_UNPROCESSABLE_ENTITY);
            // return $this->commonResponse(false, $exception->errorInfo[2], '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical('Something went wrong registering a new user. ERROR:' . $exception->getTraceAsString());
            return $this->authResponse(500, $exception->getMessage(), Response::HTTP_UNPROCESSABLE_ENTITY);
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
            return $this->bookingResponse(304, (string) Arr::flatten($validator->messages()->get('*')), 'token', '', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        try {
            $user = User::firstWhere('email', $request->email);
            if (!$user) {
                return $this->bookingResponse(404, 'A user with the provided credentials could not be found', 'token', '', Response::HTTP_EXPECTATION_FAILED);
            }
            if (!Hash::check($request->password, $user->password)) {

                return $this->bookingResponse(302, 'Invalid password', 'token',  '', Response::HTTP_EXPECTATION_FAILED);
            }
            $data = [
                'user' => new UserResource($user),
                'accessToken' => $token = $user->createToken('crm-user')->plainTextToken //generate an access token for the user
            ];
            return $this->bookingResponse(201, 'Login Success', 'token',  $token, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return $this->bookingResponse(500, (string) $exception->errorInfo[2], 'token', '', Response::HTTP_UNPROCESSABLE_ENTITY);
            // return $this->commonResponse(false, $exception->errorInfo[2], '', Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $exception) {
            Log::critical('Something went wrong logging in the user. ERROR:' . $exception->getTraceAsString());
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
                return $this->authResponse(201, 'Logout Successful', Response::HTTP_OK);
                // return $this->commonResponse(true, 'Logout Successful', '', Response::HTTP_OK);
            }
            return $this->authResponse(404, 'Failed to logout', Response::HTTP_EXPECTATION_FAILED);
            // return $this->commonResponse(false, 'Failed to logout', '', Response::HTTP_EXPECTATION_FAILED);
        } catch (Exception $exception) {
            Log::critical('Failed to perform user logout. ERROR ' . $exception->getTraceAsString());
            return $this->authResponse(500, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            // return $this->commonResponse(false, $exception->getMessage(), '', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
