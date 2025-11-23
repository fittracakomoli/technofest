<?php

namespace App\Http\Controllers\V1\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        // Coba otentikasi
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Kredensial tidak valid'], 401); // 401 Unauthorized
        }

        $user = Auth::user();
        /** @var User $user */
        // Buat token baru
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'role' => $user->roles->name,
            'token' => $token,
            'message' => 'Login berhasil',
        ], 200);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        // Menghapus token yang digunakan untuk request saat ini
        if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
        }

        return response()->json(['message' => 'Berhasil logout'], 200);
    }
}
