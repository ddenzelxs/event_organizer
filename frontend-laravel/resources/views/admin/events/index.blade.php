@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>Manajemen Event</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">+ Tambah Event</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event['name'] }}</td>
                        <td>{{ $event['date'] }}</td>
                        <td>{{ $event['time'] }}</td>
                        <td>{{ $event['location'] }}</td>
                        <td>{{ $event['status'] ? 'Aktif' : 'Nonaktif' }}</td>
                        <td>
                            <a href="{{ route('admin.events.edit', $event['id']) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.events.toggleStatus', $event['id']) }}" method="POST"
                                class="d-inline">
                                @csrf @method('PATCH')
                                <button onclick="return confirm('Yakin ingin mengubah status event ini?')"
                                    class="btn btn-sm {{ $event['status'] ? 'btn-danger' : 'btn-success' }}">
                                    {{ $event['status'] ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                            </form>
                            <a href="{{ route('admin.sessions.index', $event['id']) }}" class="btn btn-sm btn-info">Lihat
                                Sesi</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
