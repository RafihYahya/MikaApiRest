<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    use HttpResponses;
    /**
     * Login A Registered User
     */
    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'email|required|max:255',
            'password'=> 'required|max:255',
        ]);
        if (!Auth::attempt($request->only("email", "password"))) {

            return $this->Err("Wrong Email Or Pasword", 401);
        }
        $user = User::where("email", $request->email)->first();
        $token = $user->createToken('ApiToken Of ' . $user->name)->plainTextToken;

        return $this->Ok([
            "user" => $user,
            "token" => $token,
            'isAuth' => Auth::check()
        ]);
    }
    public function register(RegisterRequest $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:255|confirmed'
        ]);
        $user = User::create(
            [
                "name" => $request->name,
                "username" => $request->username,
                "email" => $request->email,
                "password" => bcrypt($request->password),
            ]
        );
        return $this->Ok([
            "user" => $user,
            "token" => $user->createToken('ApiToken Of ' . $user->name)->plainTextToken
        ]);
    }
    public function register2()
    {
        $user = User::create(
            [
                "name" => 'miaw',
                "username" => 'miaw2',
                "email" => 'miaw@gmail.com',
                "password" => bcrypt('0000'),
            ]
        );
        return $this->Ok([
            "user" => $user,
            "token" => $user->createToken('ApiToken Of ' . $user->name)->plainTextToken
        ]);
        
    }
    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
            return $this->Ok([
                'status' => 'Logged out',
                'user' => Auth::user()->name
            ]);
        }
        return $this->Err('Not Authenticated To LogOut',401);
    }

}
