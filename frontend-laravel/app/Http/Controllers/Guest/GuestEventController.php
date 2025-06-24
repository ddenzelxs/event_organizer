<?php
// app/Http/Controllers/Guest/GuestEventController.php

namespace App\Http\Controllers\Guest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class GuestEventController extends Controller
{
    public function index()
    {
        // Ganti URL di bawah ini sesuai URL backend Node.js kamu
        $response = Http::get('http://localhost:3000/api/events');

        if ($response->successful()) {
            $events = $response->json('data'); // Ambil bagian "data" dari response JSON
        } else {
            $events = [];
        }

        return view('welcome', compact('events'));
    }
}
