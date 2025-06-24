<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-900 text-white">

    <!-- Navbar -->
    <nav class="bg-gray-800 shadow p-4 flex justify-between items-center">
      <div class="text-2xl font-bold text-blue-400">EventApp</div>

      <div class="ml-auto relative dropdown">
        <a class="btn btn-secondary bg-gray-700 border-0" href="#" role="button"
           id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="flex items-center gap-2">
            <span>{{ session('user.name') ?? 'Guest' }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.188l3.71-3.958a.75.75 0 111.08 1.04l-4.25 4.52a.75.75 0 01-1.08 0l-4.25-4.52a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
          </div>
        </a>

        <ul class="dropdown-menu dropdown-menu-end mt-2 text-sm">
          <li><h6 class="dropdown-header">Profile</h6></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Log out</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><p class="dropdown-item text-center text-muted">Advanced settings</p></li>
        </ul>
      </div>
    </nav>

    <!-- Carousel -->
    <div class="container my-16">
      <div id="carouselExampleCaptions" class="carousel slide rounded-lg shadow-lg overflow-hidden">
        <div class="carousel-indicators">
          @foreach ($events as $index => $event)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}"
              @if($index === 0) class="active" aria-current="true" @endif
              aria-label="Slide {{ $index + 1 }}"></button>
          @endforeach
        </div>
        <div class="carousel-inner">
          @foreach ($events as $index => $event)
          <div class="carousel-item @if($index === 0) active @endif">
            <img src="{{ asset('placeholder.jpg') }}" class="d-block w-100" alt="{{ $event['name'] }}">
            <div class="carousel-caption d-none d-md-block bg-gradient-to-t from-black/60 via-black/30 to-transparent p-4 rounded">
              <h5 class="text-white text-xl font-semibold">{{ $event['name'] }}</h5>
              {{-- <p class="text-white">{{ $event['description'] }}</p> --}}
              <a href="#"><button type="button" class="btn btn-light">Learn More</button></a>
            </div>
          </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <!-- Event List Section -->
    <div class="container my-5">
      <h2 class="mb-4 text-white">Upcoming Events</h2>
      <div class="row g-4">
        @foreach ($events as $event)
        <div class="col-md-4">
          <div class="card bg-dark text-white h-100 shadow">
            <img src="{{ asset('placeholder.jpg') }}" class="card-img-top" alt="{{ $event['name'] }}">
            <div class="card-body">
              <h5 class="card-title">{{ $event['name'] }}</h5>
              {{-- <p class="card-text">{{ $event['description'] }}</p> --}}
              <a href="#" class="btn btn-primary">Details</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-6 text-sm text-gray-500">
      © 2025 EventApp. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
