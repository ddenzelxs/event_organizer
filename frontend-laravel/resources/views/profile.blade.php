@extends('layouts.app') {{-- Sesuaikan jika pakai layout lain --}}

@section('content')
  <!-- Navbar -->
  <nav class="bg-gray-800 shadow p-4 flex justify-between items-center">
    <div class="text-2xl font-bold text-blue-400">EventApp</div>
    <div class="ml-auto relative dropdown">
      <a class="btn btn-secondary bg-gray-700 border-0" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="flex items-center gap-2">
          <span>{{ session('user.name') ?? 'Guest' }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.188l3.71-3.958a.75.75 0 111.08 1.04l-4.25 4.52a.75.75 0 01-1.08 0l-4.25-4.52a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
          </svg>
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end mt-2 text-sm">
        <li><h6 class="dropdown-header">Profile</h6></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Log out</a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><p class="dropdown-item text-center text-muted">Advanced settings</p></li>
      </ul>
    </div>
  </nav>

  <div class="text-center pt-40 px-4">
    <h1 class="text-4xl md:text-5xl font-bold mb-6">Edit Profile</h1>
  </div>

  <!-- Edit Profile Form Section -->
  <div class="container my-5">
    <div class="card bg-gray-800 text-white shadow-lg border-0">
      <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
          @csrf
          @method('PUT')

          <!-- Full Name -->
          <div>
            <label for="editName" class="block text-white mb-1">Full Name</label>
            <input
              type="text"
              id="editName"
              name="name"
              value="{{ old('name', session('user.name')) }}"
              placeholder="Your full name"
              class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <!-- Email (Read-only) -->
          <div>
            <label for="editEmail" class="block text-white mb-1">Email Address</label>
            <input
              type="email"
              id="editEmail"
              name="email"
              value="{{ old('email', session('user.email')) }}"
              readonly
              class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 cursor-not-allowed focus:outline-none focus:ring-0"
            />
          </div>

          <!-- Username -->
          <div>
            <label for="editUsername" class="block text-white mb-1">Username</label>
            <input
              type="text"
              id="editUsername"
              name="username"
              value="{{ old('username', session('user.username')) }}"
              placeholder="Your username"
              class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <!-- Password -->
          <div>
            <label for="inputPassword" class="block text-white mb-1">Password</label>
            <input
              type="password"
              id="inputPassword"
              name="password"
              placeholder="Enter password"
              class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          <!-- Save Changes -->
          <div>
            <button
              type="submit"
              class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition"
            >
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
