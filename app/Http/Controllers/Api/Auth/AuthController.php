<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\UserRoleHelper;
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
            'role' => ['nullable', 'string'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assigning role to user
        $D['role'] = $role = $request->role ?? 'patients';
        $publicRole = ['partnerships', 'pharmacies', 'hospitals', 'doctors', 'medical-officers', 'patients', 'emergencies'];

        if(in_array($role, $publicRole)){
            $roleId = Role::where('role', $role)->first()->id;
        }else{
            $roleId = Role::where('role', 'patients')->first()->id;
        }

        $user->roles()->attach($roleId);
        $user->load('roles');


        event(new Registered($user));

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'success' => 'true',
            'message' => 'User account created successfully',
            'data' => $user,
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
            'data' => $user,
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
        $user = $request->user() ?? [];

        // return response
        return response()->json([
            'success' => $user ? 'true' : 'false',
            'message' => $user ? 'User is authenticated' : 'User is not authenticated.',
            'user' => $user
        ], $user ? 201 : 419);
    }

}
