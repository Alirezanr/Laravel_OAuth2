<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $request->validate(['email' => 'required|string|email',
            'password' => 'required|string']);

        $credential = request(['email', 'password']);
        if (!Auth::attempt($credential)) {
            return response()->json(['message' => 'Invalid email or password.'], 401);
        }
        $user = $request->user();

        $token = $user->createToken('Access Token');

        $user->access_token = $token->accessToken;

        return response()->json(['user' => $user], 200);

    }

    function signup(Request $request)
    {
        $request->validate(['name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed']);


        $user = new User(['name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)]);

        $user->save();
        $token = $user->createToken('Access Token');
        $user->access_token = $token->accessToken;

        return response()->json(['message' => 'User registered successfully.',
            'user' => $user],
            201);
    }

    function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'User logged out successfully.'], 200);
    }

    function index(Request $request)
    {
        return response()->json(["user" => $request->user()], 200);
    }
}
