<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            "email" => "unique:users|required|email",
            "name" => "required|max:225|min:3",
            "password" => "required|min:3|confirmed"
        ]);

        // Removendo o password_confirmation antes de salvar
        unset($request['password_confirmation']);


        $user = User::create($request->all());


        $token = $user->createToken($request->name);

        return ["user" => $user, "token" => $token];
    }

    // TODO create proper request
    public function login(Request $request)
    {
        $request->validate([
            "email" => "exists:users|required|email",
            "password" => "required"
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return (["message" => "Incorrect credentials"]);
        }

        $token = $user->createToken($request->email);

        return ["user" => $user, "token" => $token];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return (["message" => "See you soon"]);
    }
}
