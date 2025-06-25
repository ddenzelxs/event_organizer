<form action="{{ route('committee.events.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Judul Event</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="location" class="form-label">Lokasi</label>
        <input type="text" name="location" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Tanggal</label>
        <input type="date" name="date" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="poster" class="form-label">Poster</label>
        <input type="file" name="poster" class="form-control" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Buat Event</button>
    <a href="{{ route('committee.events.index') }}" class="btn btn-secondary">Kembali</a>
</form>
