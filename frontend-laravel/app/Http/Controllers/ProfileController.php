<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    private $baseUrl = 'http://localhost:3000/api/users';

    public function edit()
    {
        $token = session('token');
        $user = session('user');

        if (!$token || !$user) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withToken($token)->get("{$this->baseUrl}/{$user['id']}");

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal mengambil data user']);
        }

        $userData = $response->json()['data'][0]; // karena hasilnya array dalam array
        return view('profile.edit', compact('userData'));
    }

    public function update(Request $request)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $userId = session('user.id');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put("{$this->baseUrl}/{$userId}", [
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'role_id'  => $request->input('role_id'),
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'User berhasil diperbarui.');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui user.'])->withInput();
    }
    
    public function logout(Request $request)
    {
        session()->forget('token');
        session()->forget('user');

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
