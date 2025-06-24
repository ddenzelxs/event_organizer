<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    private $baseUrl = 'http://localhost:3000/api/users';

    public function listByRole($roleId)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("{$this->baseUrl}/role/{$roleId}");

        if ($response->unauthorized()) {
            return redirect()->route('login')->withErrors(['error' => 'Sesi login habis, login ulang.']);
        }

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal mengambil data pengguna']);
        }

        $users = $response->json()['data'];
        // Ambil nama role dari parameter atau dari API, jika ingin dinamis
        $roleNames = [
            1 => 'Member',
            2 => 'Administrator',
            3 => 'Finance',
            4 => 'Panitia',
        ];

        $roleName = $roleNames[$roleId] ?? 'Unknown';
        return view('admin.users.list', compact('users', 'roleName', 'roleId'));
    }

    public function create()
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("http://localhost:3000/api/roles");
        $roles = $response->json()['data'];

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email',
            'username'    => 'required|string|max:100',
            'password' => 'required|min:6',
            'role_id'  => 'required|integer',
        ]);

        $token = session('token'); // pastikan sudah login & token tersimpan

        $response = Http::withToken($token)->post($this->baseUrl, $validated);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'User berhasil ditambahkan.');
        }

        return back()->withErrors(['create' => 'Gagal menambahkan user'])->withInput();
    }

    public function edit($id)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            $data = $response->json()['data'];
            $user = $data[0];
            return view('admin.users.edit', compact('user'));
        }

        return back()->withErrors(['error' => 'Gagal mengambil data user.']);
    }

    public function update(Request $request, $id)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->PUT("{$this->baseUrl}/{$id}", [
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
}
