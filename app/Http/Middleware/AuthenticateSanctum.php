<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthenticateSanctum
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bearer = substr(strstr($request->bearerToken(), '|', false), 1);
        if ($token = DB::table('personal_access_tokens')->where('token', hash('sha256', $bearer))->first()) {
            if ($user = User::find($token->tokenable_id)) {
                Auth::login($user);
                return $next($request);
            }
        }
        return response()->json([
            'response' => [
                'code' => [
                    'key' => 404,
                    'message' =>  'unauthenticated',
                ],
            ],
        ]);
    }
}
