<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required', // Can be email or phone
            'password' => 'required',
        ]);

        // Find user by email or phone
        $user = User::where('email', $request->login)
            ->orWhere('phone_number', $request->login)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken($user->role, ['server:update'])->plainTextToken;

        return response()->json([
            'token' => $token,
            'role' => $user->role,
            'user' => $user,
        ], 200);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'nullable|email|unique:users,email',
            'phone_number'    => 'nullable|unique:users,phone_number',
            'city' => 'nullable',
            'address'=> 'nullable',
            'blood_group' => 'required',
            'experience' => 'required',
            'password' => 'required|min:6',
        ]);

        if (!$request->email && !$request->phone_number) {
            return response()->json([
                'message' => 'Either email or phone is required.',
            ], 422);
        }

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone_number'    => $request->phone_number,
            'city'     => $request->city,
            'address'    => $request->address,
            'blood_group'    => $request->blood_group,
            'experience' => $request->experience,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken($user->role ?? '0')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.',
            'token'   => $token,
            'user'    => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}
