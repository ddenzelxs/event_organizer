@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-white">Detail Event: {{ $event['name'] }}</h2>

    <div class="card mb-4 bg-dark text-white">
        <div class="card-body">
            <p><strong>Tanggal:</strong> {{ $event['date'] }}</p>
            <p><strong>Lokasi:</strong> {{ $event['location'] }}</p>
            <p><strong>Status:</strong> {{ $event['status'] == 1 ? 'Berjalan' : 'Selesai' }}</p>
        </div>
    </div>

    <h4 class="text-white">Tambah Sesi</h4>
    <form action="{{ route('committee.sessions.store', $event['id']) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label text-white">Nama Sesi</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Tanggal</label>
            <input type="date" name="session_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Waktu</label>
            <input type="time" name="session_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Pembicara</label>
            <input type="text" name="speaker" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Harga</label>
            <input type="number" step="0.01" name="price" class="form-control" value="0">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Lokasi</label>
            <input type="text" name="location" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Maksimal Peserta</label>
            <input type="number" name="max_participants" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Tambah Sesi</button>
    </form>

    <hr class="text-white my-5">

    <h4 class="text-white">Daftar Sesi</h4>
    @if (count($sessions) > 0)
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Pembicara</th>
                        <th>Harga</th>
                        <th>Lokasi</th>
                        <th>Maksimal Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session['name'] }}</td>
                            <td>{{ $session['session_date'] }}</td>
                            <td>{{ $session['session_time'] }}</td>
                            <td>{{ $session['speaker'] }}</td>
                            <td>Rp{{ number_format($session['price'], 0, ',', '.') }}</td>
                            <td>{{ $session['location'] }}</td>
                            <td>{{ $session['max_participants'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-white">Belum ada sesi untuk event ini.</p>
    @endif
</div>
@endsection
