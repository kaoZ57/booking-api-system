<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function login_view()
    {
        return view('login');
    }

    public function register_view()
    {
        return view('register');
    }
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users|min:3|max:60',
            'email' => 'required|email|unique:users',
        ]);
        $user = User::firstWhere('email', $request->email);

        if (!$user) {
            return view('login');
        }
        if (!Hash::check($request->password, $user->password)) {

            return view('login');
        }
        $data = [
            'user' => new UserResource($user),
            'accessToken' => $token = $user->createToken('crm-user')->plainTextToken //generate an access token for the user
        ];
        if (Auth::attempt($request)) {
            return redirect()->intended('home');
        }
        return view('login');
    }

    public function register()
    {
        return view('register');
    }
}
