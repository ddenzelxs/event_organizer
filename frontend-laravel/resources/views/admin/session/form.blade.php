@extends('layouts.index')

@section('content')
<div class="container">
  <h1>{{ $session ? 'Edit' : 'Tambah' }} Sesi</h1>

  <form method="POST" action="{{ $session ? route('admin.sessions.update', $session['id']) : route('admin.sessions.store', $event_id) }}">
    @csrf
    @if($session) @method('PUT') @endif

    @if($session)
      <input type="hidden" name="event_id" value="{{ $session['event_id'] }}">
    @else
      <input type="hidden" name="event_id" value="{{ $event_id }}">
    @endif

    <div class="mb-3">
      <label>Nama Sesi</label>
      <input type="text" name="name" class="form-control" value="{{ $session['name'] ?? '' }}" required>
    </div>

    <div class="mb-3">
      <label>Tanggal</label>
      <input type="date" name="session_date" class="form-control" value="{{ $session['session_date'] ?? '' }}" required>
    </div>

    <div class="mb-3">
      <label>Waktu</label>
      <input type="time" name="session_time" class="form-control" value="{{ $session['session_time'] ?? '' }}" required>
    </div>

    <div class="mb-3">
      <label>Narasumber</label>
      <input type="text" name="speaker" class="form-control" value="{{ $session['speaker'] ?? '' }}" required>
    </div>

    <div class="mb-3">
      <label>Lokasi</label>
      <input type="text" name="location" class="form-control" value="{{ $session['location'] ?? '' }}">
    </div>

    <div class="mb-3">
      <label>Kuota</label>
      <input type="number" name="max_participants" class="form-control" value="{{ $session['max_participants'] ?? '' }}">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.sessions.index', $session['event_id'] ?? $event_id) }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
