@extends('layouts.index')

@section('content')
<div class="container py-5">
    <h2 class="text-white mb-4">Buat Event Baru</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('committee.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Event</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload Poster</label>
            <input type="file" name="poster" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Buat Event</button>
        <a href="{{ route('committee.events.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
