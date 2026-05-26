<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request){
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        Auth::login($user);
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success'=>true,
            'message'=> 'User registered successfully',
            'user' => new UserResource($user),
            'token' => $token,
        ],201);
    }

    public function login(LoginUserRequest $request)
{
    $credentials = $request->validated();

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid Credentials'
        ], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'success' => true,
        'message' => 'Login Successful',
        'user' => new UserResource($user),
        'token' => $token,
    ], 200);
}

    public function Logout(Request $request){
        $user = $request->user();

         if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated user'
        ], 401);
    }
        $token = $user->currentAccessToken();

    if ($token) {
        $token->delete();
    }

    return response()->json([
        'success' => true,
        'message' => 'Logged out successfully'
    ]);
    }



}
