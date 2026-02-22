@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-house-door me-2 text-primary"></i>Dashboard Siswa</h1>
    <p class="text-muted mb-0">Selamat datang, <strong>{{ Auth::user()->nama_anggota }}</strong>!</p>
</div>

<!-- Welcome Banner -->
<div class="card mb-4" style="border:none;border-radius:12px;background:linear-gradient(135deg,#3b82f6,#1d4ed8);box-shadow:0 4px 15px rgba(59,130,246,0.3);">
    <div class="card-body p-4 text-white">
        <h4 class="fw-bold mb-1">Hai, {{ Auth::user()->nama_anggota }}! 👋</h4>
        <p class="mb-3 opacity-75">Selamat datang di perpustakaan digital. Apa yang ingin Anda lakukan hari ini?</p>
        <a href="{{ route('siswa.peminjaman') }}" class="btn btn-light fw-semibold me-2">
            <i class="bi bi-search me-1"></i> Cari & Pinjam Buku
        </a>
        <a href="{{ route('siswa.pengembalian') }}" class="btn btn-outline-light fw-semibold">
            <i class="bi bi-journal-bookmark me-1"></i> Lihat Buku Saya
        </a>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Tanggungan Aktif</div>
                    <div class="fw-bold" style="font-size:2.5rem;line-height:1;color:#1e293b;">{{ $activeBorrows }}</div>
                    <p class="text-muted mb-0" style="font-size:0.82rem;">Buku yang sedang dipinjam</p>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top" style="border-color:#f1f5f9 !important;">
                <a href="{{ route('siswa.pengembalian') }}" class="text-warning text-decoration-none" style="font-size:0.85rem;">Kembalikan buku →</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Total Pinjaman</div>
                    <div class="fw-bold" style="font-size:2.5rem;line-height:1;color:#1e293b;">{{ $totalBorrows }}</div>
                    <p class="text-muted mb-0" style="font-size:0.82rem;">Seluruh riwayat peminjaman</p>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top" style="border-color:#f1f5f9 !important;">
                <a href="{{ route('siswa.pengembalian') }}" class="text-success text-decoration-none" style="font-size:0.85rem;">Lihat riwayat →</a>
            </div>
        </div>
    </div>
</div>
@endsection
