<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SessionController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('BASE_API') . '/event-sessions';
    }

    public function index($event_id)
    {
        $response = Http::get($this->baseUrl . '?event_id=' . $event_id);
        $sessions = $response->json();
        return view('admin.session.index', compact('sessions', 'event_id'));
    }

    public function create($event_id)
    {
        return view('admin.session.form', ['event_id' => $event_id, 'session' => null]);
    }

    public function store(Request $request, $event_id)
    {
        Http::post($this->baseUrl, array_merge($request->all(), ['event_id' => $event_id]));
        return redirect()->route('admin.sessions.index', $event_id)->with('success', 'Sesi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $session = Http::get($this->baseUrl . '/' . $id)->json();
        return view('admin.session.form', compact('session'));
    }

    public function update(Request $request, $id)
    {
        Http::put($this->baseUrl . '/' . $id, $request->all());
        return redirect()->route('admin.sessions.index', $request->event_id)->with('success', 'Sesi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $session = Http::get($this->baseUrl . '/' . $id)->json();
        Http::delete($this->baseUrl . '/' . $id);
        return redirect()->route('admin.sessions.index', $session['event_id'])->with('success', 'Sesi berhasil dihapus.');
    }
}
