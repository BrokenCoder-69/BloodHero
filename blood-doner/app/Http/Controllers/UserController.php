<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->only(['name', 'email', 'phone_number']);
        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }
}
