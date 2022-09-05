<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class IsOwner
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
        $user = User::with('customers', 'roles')->find(Auth::user()->id);
        foreach ($user['roles'] as $value) {
            if ($value->name == 'owner') {
                return $next($request);
                break;
            }
        }
        return response()->json([
            'response' => [
                'code' => [
                    'key' => 209,
                    'message' =>  "don't have the right",
                ],
            ],
            'status' => Response::HTTP_FORBIDDEN,
        ], Response::HTTP_FORBIDDEN);
    }
}
