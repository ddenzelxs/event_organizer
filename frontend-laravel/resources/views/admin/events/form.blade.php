@extends('layouts.index')

@section('content')
    <div class="container">
        <h1>{{ $event ? 'Edit' : 'Tambah' }} Event</h1>

        <form method="POST" action="{{ $event ? route('admin.events.update', $event['id']) : route('admin.events.store') }}">
            @csrf
            @if ($event)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label>Nama Event</label>
                <input type="text" name="name" class="form-control" value="{{ $event['name'] ?? old('name') }}" required>
            </div>

            <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ $event['date'] ?? old('date') }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Waktu</label>
                <input type="time" name="time" class="form-control" value="{{ $event['time'] ?? old('time') }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="location" class="form-control"
                    value="{{ $event['location'] ?? old('location') }}">
            </div>

            <div class="mb-3">
                <label>Poster URL</label>
                <input type="text" name="poster_url" class="form-control"
                    value="{{ $event['poster_url'] ?? old('poster_url') }}">
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="price" class="form-control" value="{{ $event['price'] ?? 0 }}">
            </div>

            <div class="mb-3">
                <label>Kuota Maksimum</label>
                <input type="number" name="max_participants" class="form-control"
                    value="{{ $event['max_participants'] ?? 0 }}">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ isset($event['status']) && $event['status'] == 1 ? 'selected' : '' }}>Aktif
                    </option>
                    <option value="0" {{ isset($event['status']) && $event['status'] == 0 ? 'selected' : '' }}>
                        Nonaktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
