<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index()
{
    try {
        $userId = session('user.id');
        if (!$userId) {
            abort(403, 'Belum login. Session user.id kosong');
        }

        $response = Http::get('http://localhost:3000/api/profile/', [
            'id' => $userId,
        ]);

        if (!$response->successful()) {
            dd('Gagal ambil dari Node', $response->status(), $response->body());
        }

        $user = $response->json();
        return view('profile', compact('user'));

    } catch (\Exception $e) {
        dd('ERROR:', $e->getMessage(), $e->getTraceAsString());
    }
}


    public function update(Request $request)
    {
        $data = [
            'id'       => session('user.id'),
            'name'     => $request->input('name'),
            'username' => $request->input('username'),
            'email'    => $request->input('email'),
        ];

        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }

        $response = Http::put('http://localhost:3000/api/profile', $data);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'Profil berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Gagal update profil: ' . $response->body());
        }
    }
}
