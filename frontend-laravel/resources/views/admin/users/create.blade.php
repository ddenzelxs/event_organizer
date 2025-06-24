@extends('layouts.index')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">Tambah Pengguna</h2>

  <form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Username</label>
      <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Role</label>
      <select name="role_id" class="form-select" required>
        <option disabled selected>Pilih role</option>
        @foreach ($roles as $role)
          <option value="{{ $role['id'] }}">{{ ucfirst($role['nama_role']) }}</option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Tambah</button>
    <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
