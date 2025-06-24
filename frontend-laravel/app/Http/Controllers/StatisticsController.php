<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StatisticsController extends Controller
{
    private $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:3000/api/statistics';
    }

    public function adminIndex()
    {
        $token = session('token');

        if (!$token) {
            return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu']);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($this->baseUrl . '/summary');

        if ($response->unauthorized()) {
            return redirect()->route('login')->withErrors(['error' => 'Sesi login telah habis. Silakan login ulang.']);
        }

        if (!$response->successful()) {
            return back()->withErrors(['error' => 'Gagal mengambil data statistik']);
        }

        $summary = $response->json()['data'];

        // Ambil masing-masing variabel dari API
        $eventBerjalan = $summary['eventBerjalan'];
        $eventSelesai = $summary['eventSelesai'];
        $totalPengguna = $summary['totalPengguna'];

        return view('admin.index', compact('eventBerjalan', 'eventSelesai', 'totalPengguna'));
    }
}
