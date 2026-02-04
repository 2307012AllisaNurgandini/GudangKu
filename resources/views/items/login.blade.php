<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login GudangKu</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

<div class="card shadow border-0 rounded-4 p-4" style="max-width: 380px; width: 100%;">

    <!-- LOGO -->
    <div class="text-center mb-3">
        <img src="{{ asset('image/logoGudangKu.png') }}" alt="Logo GudangKu" class="mb-2" width="80" height="80">
    </div>

    <!-- JUDUL -->
    <h5 class="text-center fw-bold text-primary mb-1">Selamat Datang</h5>
    <p class="text-center text-muted small mb-4">Masukkan akun GudangKu</p>

    <!-- FORM LOGIN -->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL -->
        <div class="mb-3">
            <label class="form-label small text-muted">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope text-primary"></i>
                </span>
                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       placeholder="nama@gmail.com"
                       value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
                <div class="invalid-feedback d-block small">{{ $message }}</div>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div class="mb-3">
            <label class="form-label small text-muted">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-lock text-primary"></i>
                </span>
                <input type="password"
                       name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Masukkan password" required>
            </div>
            @error('password')
                <div class="invalid-feedback d-block small">{{ $message }}</div>
            @enderror
        </div>

        <!-- BUTTON LOGIN -->
        <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>
    </form>

</div>

</body>
</html>