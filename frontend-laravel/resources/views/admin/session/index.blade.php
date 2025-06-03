@extends('layouts.index')

@section('content')
<div class="container">
  <h1>Daftar Sesi Event #{{ $event_id }}</h1>
  <a href="{{ route('admin.sessions.create', $event_id) }}" class="btn btn-primary mb-3">+ Tambah Sesi</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Narasumber</th>
        <th>Lokasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($sessions as $s)
        <tr>
          <td>{{ $s['name'] }}</td>
          <td>{{ $s['session_date'] }}</td>
          <td>{{ $s['session_time'] }}</td>
          <td>{{ $s['speaker'] }}</td>
          <td>{{ $s['location'] }}</td>
          <td>
            <a href="{{ route('admin.sessions.edit', $s['id']) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('admin.sessions.destroy', $s['id']) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button onclick="return confirm('Yakin hapus sesi ini?')" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
