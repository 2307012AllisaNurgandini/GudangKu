<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudangku - Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
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
    <div class="print-header">
        <h2>DETAIL DATA BARANG</h2>
        <p>Aplikasi Manajemen Gudangku</p>
    </div>

    <h2 class="no-print">Detail Barang</h2>

    <div class="mb-3 no-print">
        <a href="{{ route('items.index') }}" class="btn btn-custom-info">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button onclick="window.print()" class="btn btn-secondary no-print" title="Cetak ke PDF">
    <i class="fas fa-print"></i>
</button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th class="table-light">Nama Barang</th>
                    <td>{{ $item->name }}</td>
                </tr>
                <tr>
                    <th class="table-light">Kategori</th>
                    <td>{{ $item->category }}</td>
                </tr>
                <tr>
                    <th class="table-light">Jumlah Stok</th>
                    <td>{{ $item->quantity }} unit</td>
                </tr>
                <tr>
                    <th class="table-light">Harga Satuan</th>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th class="table-light">Total Nilai Barang</th>
                    <td><strong>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <th class="table-light">Tanggal Input</th>
                    <td>{{ $item->created_at->translatedFormat('d F Y H:i') }}</td>
                </tr>
                <tr>
                    <th class="table-light">Terakhir Diperbarui</th>
                    <td>{{ $item->updated_at->translatedFormat('d F Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4 d-none d-print-block">
        <p class="text-end" style="font-size: 12px;">Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>