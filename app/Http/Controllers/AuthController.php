<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Mengimport Model User
use App\Models\User;
// Mengimport Hash Password
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Membuat method register
    public function register(Request $request)
    {
        // Menangkap data request
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // Menggunakan model eloquent untuk insert user
        $user = User::create($input);

        $data = [
            'message' => 'User is created successfully'
        ];
        // mengirim data json dan kode 200 (the request succeeded)
        return response()->json($data, 200);
    }

    // Membuat method login
    public function login(Request $request)
    {
        // Menangkap data request
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // Menggunakan model eloquent untuk where user
        $user = User::where('email', $input['email'])->first();

        // Check email dan password
        $isLoginSuccessfully = (
            $input['email'] == $user->email
            &&
            Hash::check($input['password'], $user->password)
        );
        // Jika berhasil login
        if ($isLoginSuccessfully) {
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'Login succeesfully',
                'token' => $token->plainTextToken
            ];
            // mengirim data json dan kode 200 (the request succeeded)
            return response()->json($data, 200);
        } else {
            // Jika gagal login
            $data = [
                'message' => 'Username or Password is wrong'
            ];
            // mengirim data json dan kode 401 (Unauthenticated)
            return response()->json($data, 401);
        }
    }
}
