<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota — Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, sans-serif;
            padding: 2rem 0;
        }
        .register-card {
            width: 100%;
            max-width: 560px;
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .register-header {
            background: linear-gradient(135deg, #10b981, #065f46);
            border-radius: 16px 16px 0 0;
            padding: 1.5rem 2rem;
            text-align: center;
        }
        .register-body { padding: 1.75rem 2rem; }
        .form-control:focus, .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16,185,129,.2);
        }
        .section-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6b7280;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
    </style>
</head>
<body>
<div class="register-card card">
    <div class="register-header">
        <h4 class="text-white fw-bold mb-1"><i class="bi bi-person-plus me-2"></i>Registrasi Anggota</h4>
        <p class="text-white-50 mb-0" style="font-size:0.85rem;">Daftarkan diri sebagai anggota perpustakaan</p>
    </div>
    <div class="register-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <a href="{{ route('login') }}" class="alert-link ms-1">Silakan Login</a>.
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                @foreach ($errors->all() as $error) {{ $error }}<br> @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="section-title"><i class="bi bi-id-card me-1"></i>Data Diri Siswa</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">NIS</label>
                    <input type="text" class="form-control" name="nis" value="{{ old('nis') }}" placeholder="Nomor Induk Siswa">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" name="nama_anggota" value="{{ old('nama_anggota') }}" required>
                    @error('nama_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kelas</label>
                    <input type="text" class="form-control" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XI">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <input type="text" class="form-control" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: RPL">
                </div>
            </div>

            <div class="section-title mt-3"><i class="bi bi-key me-1"></i>Akun Login</div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required minlength="6">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Minimal 6 karakter.</div>
                </div>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fw-semibold mt-2">
                <i class="bi bi-check-circle me-2"></i>Daftar Sekarang
            </button>
        </form>

        <hr class="my-3">
        <p class="text-center text-muted mb-0" style="font-size:0.88rem;">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login di sini</a>
        </p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
