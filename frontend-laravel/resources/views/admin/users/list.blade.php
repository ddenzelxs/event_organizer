@extends('layouts.index')

@section('content')
    <div class="container py-4">
        <h2 class="text-white mb-4">Daftar Pengguna Role: {{ ucfirst($roleName) }}</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-4">
            + Tambah User
        </a>
        @if (count($users) > 0)
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ ucfirst($user['nama_role']) }}</td>
                                <td><a href="{{ route('admin.users.edit', $user['id']) }}" class="btn btn-warning btn-sm">Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning text-white">
                Tidak ada pengguna dengan role ini.
            </div>
        @endif
    </div>
@endsection
