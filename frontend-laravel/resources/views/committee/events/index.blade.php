@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Event Saya</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <a href="{{ route('committee.events.create') }}" class="btn btn-primary mb-3">+ Buat Event Baru</a>

    @if (count($events) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-white">
                <thead class="table-dark">
                    <tr>
                        <th>Judul</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr>
                        <td>{{ $event['name'] }}</td>
                        <td>{{ $event['location'] }}</td>
                        <td>{{ date('d M Y', strtotime($event['date'])) }}</td>
                        <td>
                            @if ($event['status'] == 1)
                                <span class="badge bg-success">Berjalan</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('committee.events.show', $event['id']) }}" class="btn btn-info btn-sm">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning">Belum ada event yang dibuat.</div>
    @endif
</div>
@endsection
