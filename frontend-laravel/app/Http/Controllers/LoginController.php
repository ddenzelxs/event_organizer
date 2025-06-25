<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    private $baseUrl = 'http://localhost:3000/api/auth';

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


    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email',
            'username' => 'required|string|max:100',
            'password' => 'required|min:6',
        ]);

        // Tambahkan role_id = 1 secara default
        $validated['role_id'] = 1;

        try {
            $response = Http::post('http://localhost:3000/api/users', $validated);

            if ($response->successful()) {
                return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
            }

            return back()->withErrors(['error' => 'Registrasi gagal: ' . $response->body()])->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Server error: ' . $e->getMessage()])->withInput();
        }
    }
}
