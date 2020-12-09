<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $request->validate(['email'    => 'required|string|email',
                            'password' => 'required|string']);
    }

    function signup(Request $request)
    {
        $request->validate(['name'     => 'required|string',
                            'email'    => 'required|string|email|unique:users',
                            //confirmed:we need to pass tow passwords and both should match
                            'password' => 'required|string|confirmed']);


        $user = new User(['name'     => $request->name,
                          'email'    => $request->email,
                          'password' => bcrypt($request->password)]);

        $user->save();

        return response()->json(['message' => 'user registered successfully.'], 201);
    }

    function hello()
    {
        return "Hello from AuthController";
    }
}
