@extends('layouts.index')

@section('content')
<div class="container">
    <h1>Daftar Admin</h1>
    <table class="table-hover">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins['data'] as $user)
                <tr>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['nama_role'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
