@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-bookshelf me-2 text-primary"></i>Daftar Buku Perpustakaan</h1>
        <p class="text-muted mb-0">Pilih buku yang ingin Anda pinjam</p>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
    @forelse($books as $book)
        <div class="col">
            <div class="card book-card">
                <div class="card-header d-flex align-items-center gap-2" style="background:#eff6ff;border-bottom:1px solid #dbeafe;">
                    <div style="width:36px;height:36px;background:#3b82f6;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-book text-white"></i>
                    </div>
                    <div style="overflow:hidden;">
                        <div class="fw-bold text-primary" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $book->judul_buku }}</div>
                        <div class="text-muted" style="font-size:0.75rem;"><code>{{ $book->kode_buku }}</code></div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    <table class="table table-borderless table-sm mb-0" style="font-size:0.87rem;">
                        <tr>
                            <td class="text-muted ps-0" style="width:35%;">Pengarang</td>
                            <td class="fw-semibold">{{ $book->pengarang }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Penerbit</td>
                            <td>{{ $book->penerbit }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Tahun</td>
                            <td><span class="badge bg-secondary-subtle text-secondary">{{ $book->tahun }}</span></td>
                        </tr>
                        <tr>
                            <td class="text-muted ps-0">Stok</td>
                            <td>
                                @if($book->stok > 0)
                                    <span class="badge bg-success-subtle text-success"><i class="bi bi-check-circle me-1"></i>{{ $book->stok }} tersedia</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger"><i class="bi bi-x-circle me-1"></i>Stok Habis</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer bg-white border-top-0 pt-0">
                    <form action="{{ route('siswa.peminjaman.store', $book->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm w-100" {{ $book->stok <= 0 ? 'disabled' : '' }}>
                            @if($book->stok > 0)
                                <i class="bi bi-plus-circle me-1"></i>Pinjam Buku Ini
                            @else
                                <i class="bi bi-x-circle me-1"></i>Stok Habis
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card form-card">
                <div class="card-body text-center py-5 text-muted">
                    <i class="bi bi-journal-x display-4 d-block mb-3"></i>
                    <p>Belum ada buku di perpustakaan.</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection
