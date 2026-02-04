<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudangku - Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

<div class="print-only-title">
    <h2>LAPORAN DAFTAR BARANG - GUDANGKU</h2>
    @if(request('date'))
        <h4>Per Tanggal: {{ \Carbon\Carbon::parse(request('date'))->format('d F Y') }}</h4>
    @else
        <h4>Semua Data Barang</h4>
    @endif
    <p>Dicetak pada: {{ date('d-m-Y H:i') }}</p>
</div>

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

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Daftar Barang</h2>
        <div class="d-flex gap-2 no-print">
            <a href="{{ route('items.create') }}" class="btn btn-custom-info btn-sm">Tambah Barang</a>
            <button onclick="window.print()" class="btn btn-secondary btn-sm">
                <i class="fas fa-print"></i> Cetak ke PDF
            </button>
        </div>
    </div>

    <form method="GET" action="{{ route('items.index') }}" class="row g-2 mb-3 no-print align-items-end">
        <input type="hidden" name="search" value="{{ request('search') }}">
        <div class="col-12 col-md-3">
            <label class="form-label fw-bold small">Pilih Tanggal Masuk</label>
            <input type="date" class="form-control" name="date" value="{{ request('date') }}">
        </div>
        <div class="col-6 col-md-auto">
            <button type="submit" class="btn btn-custom-info w-100">
                <i class="fas fa-eye"></i> Tampilkan
            </button>
        </div>
        <div class="col-6 col-md-auto">
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
        </div>
    </form>

    <form method="GET" action="{{ route('items.index') }}" class="row g-2 mb-4 no-print">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <div class="col-8 col-md-4">
            <input type="text" class="form-control" name="search" placeholder="Cari nama atau kategori..." value="{{ request('search') }}">
        </div>
        <div class="col-4 col-md-auto">
            <button type="submit" class="btn btn-custom-info w-100">Cari</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show no-print" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th style="min-width: 180px;">Nama Barang</th>
                    <th style="min-width: 130px;">Kategori</th>
                    <th style="width: 80px;">Jumlah</th>
                    <th style="min-width: 140px;">Harga</th>
                    <th class="no-print" style="min-width: 200px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-center no-print">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-info btn-sm btn-custom-info">Detail</a>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>