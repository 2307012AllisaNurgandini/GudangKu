<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Gudangku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom no-print">
    <div class="container">

        <!-- Logo -->
        <div class="d-flex align-items-center">
            <img src="{{ asset('image/logoGudangKu.png') }}"
                 width="40"
                 height="40"
                 class="me-2 rounded-circle">

            <a class="navbar-brand">Gudangku</a>
        </div>

        <!-- Logout -->
        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    Logout
                </button>
            </form>
        </div>

    </div>
</nav>

<div class="container mt-5">
    <h2>Edit Barang</h2>
    <!-- Tombol Kembali biru muda -->
    <a href="{{ route('items.index') }}" class="btn btn-custom-info mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Barang</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <input type="text" name="category" class="form-control" id="category" value="{{ old('category', $item->category) }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity', $item->quantity) }}" min="0" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="number" name="price" class="form-control" id="price" value="{{ old('price', $item->price) }}" min="0" step="0.01" required>
        </div>

        <!-- Tombol Simpan / Perbarui biru muda -->
        <button type="submit" class="btn btn-custom-info">Simpan</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>