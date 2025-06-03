<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('BASE_API') . '/events';
    }

    public function index()
    {
        $events = Http::get($this->baseUrl)->json();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.form', ['event' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Http::post($this->baseUrl, $data);
        return redirect()->route('admin.events.index')->with('success', 'Event ditambahkan.');
    }

    public function edit($id)
    {
        $event = Http::get("{$this->baseUrl}/{$id}")->json();
        return view('admin.events.form', compact('event'));
    }

    public function update(Request $request, $id)
    {
        Http::put("{$this->baseUrl}/{$id}", $request->all());
        return redirect()->route('admin.events.index')->with('success', 'Event diperbarui.');
    }

    public function toggleStatus($id)
    {
        $response = Http::patch(env('BASE_API') . "/events/{$id}/toggle-status");

        if ($response->successful()) {
            return redirect()->route('admin.events.index')->with('success', $response->json('message'));
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah status event.');
        }
    }
}
