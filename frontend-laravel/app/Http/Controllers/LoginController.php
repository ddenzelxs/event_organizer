<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $response = Http::post('http://localhost:3000/api/auth/login', [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);

        // Jika berhasil login
        if ($response->successful()) {
            $data = $response->json();

            // Simpan token ke sesi Laravel (optional)
            session([
                'user' => $data['user'],
                'token' => $data['token'],
            ]);

            return redirect()->route('dashboard')->with('success', 'Login berhasil');
        }

        // Jika gagal
        return back()->withErrors(['login' => $response->json()['message'] ?? 'Login gagal'])->withInput();
    }
}
