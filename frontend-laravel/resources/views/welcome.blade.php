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
      <div>
        <a href="{{route('login')}}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="text-center py-20 px-4">
      <h1 class="text-4xl md:text-5xl font-bold mb-6">Selamat Datang di EventApp</h1>
      <a href="{{route('register')}}" class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-700">Daftar Sekarang</a>
    </section>

    <!-- Carousel -->
    <div class="container my-16">
      <div id="carouselExampleCaptions" class="carousel slide rounded-lg shadow-lg overflow-hidden" data-bs-ride="carousel">
        @if(count($events) > 0)
          <div class="carousel-indicators">
            @foreach($events as $index => $event)
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
            @foreach($events as $index => $event)
              <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ $event['poster_url'] }}" class="d-block w-100 object-cover" style="height: 500px;" alt="{{ $event['name'] }}">
                <div class="carousel-caption d-none d-md-block bg-gradient-to-t from-black/60 via-black/30 to-transparent p-4 rounded">
                  <h5 class="text-white text-xl font-semibold">{{ $event['name'] }}</h5>
                  <p class="text-white">{{ $event['location'] ?? '-' }} | {{ $event['date'] }}</p>
                  <a href="#">
                    <button type="button" class="btn btn-light">Pelajari Lebih Lanjut</button>
                  </a>
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
        @else
          <div class="text-center text-gray-400">Tidak ada event yang tersedia saat ini.</div>
        @endif
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
