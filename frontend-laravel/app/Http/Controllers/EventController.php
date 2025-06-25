<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    protected $baseUrl = 'http://localhost:3000/api/events';

    // Ambil semua event
    public function guestIndex()
    {
        $response = Http::get($this->baseUrl);

        if ($response->successful()) {
            $data = $response->json();
            return view('welcome', ['events' => $data['data']]);
        }

        return back()->withErrors(['error' => 'Gagal mengambil data event.']);
    }

    public function authIndex()
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
    public function index()
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withToken($token)->get($this->baseUrl . '/my');

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal mengambil data event']);
        }

        $events = $response->json()['data'];

        return view('committee.events.index', compact('events'));
    }
    // Panitia
    public function panitiaEventIndex()
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withToken($token)->get($this->baseUrl);

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal mengambil data event']);
        }

        $events = $response->json()['data'];

        return view('committee.events.index', compact('events'));
    }

    public function panitiaCreate()
    {
        return view('committee.events.create');
    }

    public function panitiaStore(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'date'       => 'required|date',
            'location'   => 'required|string|max:255',
            'poster'     => 'nullable|image|max:2048',
        ]);

        $token = session('token');
        $user = session('user'); // pastikan user login disimpan di session
        $posterPath = null;

        // Simpan file poster jika ada
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        $payload = [
            'name'        => $request->input('name'),
            'date'        => $request->input('date'),
            'location'    => $request->input('location'),
            'poster_url'  => $posterPath,
            'status'      => 0, // default belum aktif
            'managed_by'  => $user['id'] ?? null,
            'created_by'  => $user['id'] ?? null,
        ];

        $response = Http::withToken($token)->post('http://localhost:3000/api/events', $payload);

        if ($response->successful()) {
            return redirect()->route('committee.events.index')->with('success', 'Event berhasil dibuat.');
        }

        return back()->withErrors(['error' => 'Gagal membuat event.'])->withInput();
    }


    public function panitiaShow($id)
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $eventResponse = Http::withToken($token)->get("{$this->baseUrl}/{$id}");
        $sessionResponse = Http::withToken($token)->get("{$this->baseUrl}/{$id}/sessions");

        if ($eventResponse->successful() && $sessionResponse->successful()) {
            $event = $eventResponse->json()['data'];
            $sessions = $sessionResponse->json()['data'];
            return view('committee.events.show', compact('event', 'sessions'));
        }
        return back()->withErrors(['error' => 'Gagal mengambil data detail event.']);
    }

    public function addSession(Request $request, $eventId)
    {
        $token = session('token');

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'speaker' => 'required|string|max:255',
            'price' => 'required|numeric',
            'location' => 'nullable|string|max:200',
            'max_participants' => 'nullable|integer'
        ]);

        $data = array_merge($validated, ['event_id' => $eventId]);

        $response = Http::withToken($token)->post("http://localhost:3000/api/sessions", $data);
        if ($response->successful()) {
            return redirect()->route('committee.events.show', $eventId)->with('success', 'Sesi berhasil ditambahkan.');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan sesi.'])->withInput();
    }
}
