@extends('layouts.index')
@section('content')
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
@endsection
