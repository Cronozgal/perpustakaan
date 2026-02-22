@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard Admin</h1>
    <p class="text-muted mb-0">Selamat datang, <strong>{{ Auth::user()->nama_anggota }}</strong>!</p>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="stat-icon bg-primary-subtle text-primary">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Total Buku</div>
                    <div class="fw-bold" style="font-size:2rem;line-height:1.1;color:#1e293b;">{{ $totalBooks }}</div>
                    <a href="{{ route('books.index') }}" class="text-decoration-none text-primary" style="font-size:0.82rem;">Kelola Buku →</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="stat-icon bg-success-subtle text-success">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Anggota</div>
                    <div class="fw-bold" style="font-size:2rem;line-height:1.1;color:#1e293b;">{{ $totalMembers }}</div>
                    <a href="{{ route('members.index') }}" class="text-decoration-none text-success" style="font-size:0.82rem;">Kelola Anggota →</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="stat-icon bg-warning-subtle text-warning">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div>
                    <div class="text-muted" style="font-size:0.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Dipinjam</div>
                    <div class="fw-bold" style="font-size:2rem;line-height:1.1;color:#1e293b;">{{ $activeBorrows }}</div>
                    <a href="{{ route('transactions.index') }}" class="text-decoration-none text-warning" style="font-size:0.82rem;">Lihat Transaksi →</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card form-card mb-4">
    <div class="card-header"><i class="bi bi-lightning me-2 text-warning"></i>Aksi Cepat</div>
    <div class="card-body d-flex flex-wrap gap-2">
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
        <a href="{{ route('members.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus me-1"></i> Daftarkan Anggota
        </a>
        <a href="{{ route('transactions.create') }}" class="btn btn-info text-white">
            <i class="bi bi-journal-arrow-down me-1"></i> Catat Transaksi
        </a>
    </div>
</div>
@endsection
