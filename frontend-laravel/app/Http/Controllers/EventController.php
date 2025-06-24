<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    protected $baseUrl = 'http://localhost:3000/api/events';

    // Ambil semua event
    public function index()
    {
        $response = Http::get($this->baseUrl);

        if ($response->successful()) {
            $data = $response->json();
            return view('dashboard', ['events' => $data['data']]);
        }

        return back()->withErrors(['error' => 'Gagal mengambil data event.']);
    }

    // Ambil detail satu event
    public function show($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            $data = $response->json();
            return view('events.show', ['event' => $data['data']]);
        }

        return back()->withErrors(['error' => 'Event tidak ditemukan.']);
    }

    // Tampilkan form create (opsional)
    public function create()
    {
        return view('events.create');
    }

    // Kirim data event baru
    public function store(Request $request)
    {
        $response = Http::post($this->baseUrl, $request->all());

        if ($response->successful()) {
            return redirect()->route('events.index')->with('success', 'Event berhasil dibuat');
        }

        return back()->withErrors(['error' => 'Gagal membuat event'])->withInput();
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            $data = $response->json();
            return view('events.edit', ['event' => $data['data']]);
        }

        return back()->withErrors(['error' => 'Gagal mengambil data event']);
    }

    // Update event
    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->baseUrl}/{$id}", $request->all());

        if ($response->successful()) {
            return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui event'])->withInput();
    }

    // Hapus event
    public function destroy($id)
    {
        $response = Http::delete("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('events.index')->with('success', 'Event berhasil dihapus');
        }

        return back()->withErrors(['error' => 'Gagal menghapus event']);
    }
}
