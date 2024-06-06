<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;


class AuthController extends Controller
{

    public function register(Request $request)
    {

        // Validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'User account created successfully',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(LoginRequest $request)
    {

        // Authenticate request
        $request->authenticate();

        // Get user
        $user = $request->user();

        // Delete all user tokens
        $user->tokens()->delete();

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'User login successful',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function logout(Request $request)
    {
        // Get user
        $user = $request->user();

        // Delete all user tokens
        $user->tokens()->delete();

        // return response
        return response()->json([
            'success' => 'true',
            'message' => 'Logout successful',
            'user' => $user
        ], 200);
    }

    public function auth(Request $request)
    {
        // Get user
        $user = $request->user();

        // return response
        return response()->json([
            'success' => 'true',
            'message' => $user ? 'User is authenticated' : 'User is not authenticated.',
            'user' => $user
        ], $user ? 201 : 419);
    }

}
