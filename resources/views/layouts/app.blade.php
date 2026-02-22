<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Perpustakaan') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 240px;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #3b82f6;
        }
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        /* === SIDEBAR === */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: all 0.3s;
        }
        #sidebar .sidebar-brand {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid #334155;
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        #sidebar .sidebar-brand i { color: #60a5fa; }
        #sidebar .nav-link {
            color: #94a3b8;
            padding: 0.65rem 1.5rem;
            border-radius: 0;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        #sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            color: #e2e8f0;
        }
        #sidebar .nav-link.active {
            background: var(--sidebar-active);
            color: #fff;
        }
        #sidebar .nav-link i { width: 20px; }
        #sidebar .sidebar-section {
            padding: 0.5rem 1.5rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #475569;
            margin-top: 0.5rem;
        }

        /* === TOPBAR === */
        #topbar {
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            z-index: 99;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }

        /* === MAIN CONTENT === */
        #main-content {
            margin-left: var(--sidebar-width);
            padding-top: 56px;
        }
        .page-content {
            padding: 1.75rem;
        }
        .page-header {
            margin-bottom: 1.5rem;
        }
        .page-header h1 {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0;
        }

        /* === STAT CARDS === */
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-2px); }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
        }

        /* === TABLES === */
        .table-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .table-card .table { margin-bottom: 0; }
        .table-card thead th {
            background: #f8fafc;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.85rem 1rem;
        }
        .table-card tbody td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
            border-color: #f1f5f9;
            font-size: 0.9rem;
        }
        .table-card tbody tr:last-child td { border-bottom: none; }
        .table-card tbody tr:hover { background: #f8fafc; }

        /* === FORM CARDS === */
        .form-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .form-card .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 600;
            color: #1e293b;
            padding: 1rem 1.25rem;
        }

        /* === ALERTS === */
        @auth
        .alert { border-radius: 10px; font-size: 0.9rem; }
        @endauth

        /* === BOOKS CARDS === */
        .book-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }
        .book-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }
        .book-card .card-header {
            border-radius: 12px 12px 0 0 !important;
        }

        /* hide sidebar on mobile */
        @media (max-width: 767px) {
            #sidebar { width: 0; overflow: hidden; }
            #topbar, #main-content { left: 0; margin-left: 0; }
        }
    </style>
</head>
<body>

@auth
<!-- ===== SIDEBAR ===== -->
<div id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-book-fill me-2"></i>Perpustakaan
    </div>

    @if(Auth::user()->role === 'admin')
        <div class="sidebar-section">Admin Panel</div>
        <ul class="nav flex-column mt-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
        </ul>
        <div class="sidebar-section">Kelola Data</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/books*') ? 'active' : '' }}" href="{{ route('books.index') }}">
                    <i class="bi bi-journal-text me-2"></i> Data Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/members*') ? 'active' : '' }}" href="{{ route('members.index') }}">
                    <i class="bi bi-people me-2"></i> Data Anggota
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                    <i class="bi bi-arrow-left-right me-2"></i> Transaksi
                </a>
            </li>
        </ul>
    @elseif(Auth::user()->role === 'siswa')
        <div class="sidebar-section">Menu Siswa</div>
        <ul class="nav flex-column mt-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('siswa.dashboard') }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('siswa/peminjaman') ? 'active' : '' }}" href="{{ route('siswa.peminjaman') }}">
                    <i class="bi bi-bookshelf me-2"></i> Pinjam Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('siswa/pengembalian') ? 'active' : '' }}" href="{{ route('siswa.pengembalian') }}">
                    <i class="bi bi-journal-bookmark me-2"></i> Buku Saya
                </a>
            </li>
        </ul>
    @endif

    <!-- Logout at bottom -->
    <div class="mt-auto position-absolute bottom-0 w-100 mb-3">
        <hr style="border-color:#334155; margin:0 0 0.75rem;">
        <div class="px-3">
            <div class="d-flex align-items-center mb-2">
                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" style="width:32px;height:32px;flex-shrink:0;">
                    <i class="bi bi-person-fill text-white" style="font-size:0.85rem;"></i>
                </div>
                <div style="overflow:hidden;">
                    <div class="text-white fw-semibold" style="font-size:0.82rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ Auth::user()->nama_anggota }}</div>
                    <div class="text-slate-400" style="font-size:0.72rem;color:#94a3b8;">{{ ucfirst(Auth::user()->role) }}</div>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-outline-secondary w-100 text-white border-secondary" type="submit">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- ===== TOPBAR ===== -->
<div id="topbar">
    <div class="me-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:0.85rem;">
                <li class="breadcrumb-item active">{{ config('app.name', 'Perpustakaan') }}</li>
            </ol>
        </nav>
    </div>
    @if(session('success'))
        <span class="badge bg-success-subtle text-success me-3"><i class="bi bi-check-circle me-1"></i>{{ session('success') }}</span>
    @endif
    <span class="badge bg-primary-subtle text-primary" style="font-size:0.8rem;">
        <i class="bi bi-circle-fill me-1" style="font-size:0.4rem;"></i> Online
    </span>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div id="main-content">
    <div class="page-content">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>

@else
{{-- AUTH PAGES (no sidebar) --}}
<div>
    @yield('content')
</div>
@endauth

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
