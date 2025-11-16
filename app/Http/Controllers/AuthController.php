<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = User::create($data);

        return response()->json(
            [
                'message' => 'User created successfully',
                'user' => $user,
            ],
            201
        );
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $user = User::where('email', $data['email'])->first();
        if (!$user || !password_verify($data['password'], $user->password)) {
            return response()->json(
                [
                    'message' => 'invalid credentails'
                ],
                401
            );
        }
        $token = $user->createToken($user->email)->plainTextToken;
        return response()->json(
            [
                'message' => 'User logged in successfully',
                'user' => $user,
                'token' => $token,
            ],
            200
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'message' => 'User logged out successfully',
            ],
            200
        );
    }
    public function user(Request $request)
    {
        return response()->json(
            [
                'user' => $request->user(),
            ],
            200
        );
    }
}
