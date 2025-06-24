@extends('layouts.index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Pengguna</h2>

    <form action="{{ route('admin.users.update', $user['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user['name']) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user['email']) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password (biarkan kosong jika tidak ingin diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role_id" class="form-select" required>
                <option value=3 {{ $user['role_id'] == 3 ? 'selected' : '' }}>Finance</option>
                <option value=4 {{ $user['role_id'] == 4 ? 'selected' : '' }}>Event Committee</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
