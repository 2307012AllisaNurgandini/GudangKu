<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Gudangku - Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
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
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h2 class="h5 mb-0">Tambah Barang Baru</h2>
        </div>
        <div class="card-body">
            <form id="formBarang" action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Barang</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="masukan nama barang">
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label fw-bold">Kategori</label>
                    <input type="text" name="category" class="form-control" id="category" placeholder="masukan kategori barang">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label fw-bold">Jumlah</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label fw-bold">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" id="price" min="0">
                    </div>
                </div>

                <div class="card-body">
    <div class="d-flex gap-2 mb-4">
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Kembali</a>

        <button type="button" id="btnSimpan" class="btn btn-custom-info">Simpan Data Barang</button>
    </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('btnSimpan').addEventListener('click', function() {
    // Ambil input
    const name = document.getElementById('name').value.trim();
    const category = document.getElementById('category').value.trim();
    const quantity = document.getElementById('quantity').value;
    const price = document.getElementById('price').value;

    // Validasi Sederhana
    if (!name || !category || !quantity || !price) {
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: 'Semua kolom harus diisi, jangan ada yang kosong ya!',
            confirmButtonColor: '#5bc0de'
        });
        return;
    }

    // Validasi Angka Negatif
    if (quantity < 0 || price < 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Angka Tidak Valid',
            text: 'Jumlah dan Harga tidak boleh kurang dari 0!',
            confirmButtonColor: '#5bc0de'
        });
        return;
    }

    // Konfirmasi Berhasil
    Swal.fire({
        icon: 'success',
        title: 'Barang berhasil ditambahkan!',
        text: 'Data sedang diproses ke gudang...',
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        document.getElementById('formBarang').submit();
    });
});
</script>

</body>
</html>