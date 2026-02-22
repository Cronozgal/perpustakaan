@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1><i class="bi bi-journal-bookmark me-2 text-warning"></i>Buku Saya</h1>
        <p class="text-muted mb-0">Tanggungan dan riwayat peminjaman Anda</p>
    </div>
    <a href="{{ route('siswa.peminjaman') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-search me-1"></i> Cari Buku Lain
    </a>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border:none;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
            <div class="modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:40px;height:40px;background:#fef3c7;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-exclamation-triangle text-warning fs-5"></i>
                    </div>
                    <h5 class="modal-title fw-bold mb-0">Konfirmasi Pengembalian</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body pt-3">
                <p class="text-muted mb-1">Anda akan mengembalikan buku:</p>
                <div class="p-3 rounded-3 mb-3" style="background:#f8fafc;border:1px solid #e2e8f0;">
                    <strong class="text-primary" id="judul-buku-modal"></strong>
                </div>
                <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i>Pastikan buku sudah berada dalam kondisi baik sebelum dikembalikan.</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="form-kembali" action="" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success fw-semibold">
                        <i class="bi bi-arrow-return-left me-1"></i> Ya, Kembalikan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tanggungan Aktif -->
<div class="card table-card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background:#fffbeb;border-bottom:1px solid #fde68a;">
        <i class="bi bi-hourglass-split text-warning"></i>
        <strong>Buku Sedang Dipinjam</strong>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $activeCount = 0; @endphp
                @foreach($transactions as $trx)
                    @if($trx->status === 'dipinjam')
                        @php $activeCount++; @endphp
                        <tr>
                            <td>
                                <strong>{{ $trx->book->judul_buku ?? 'Buku Dihapus' }}</strong><br>
                                <small class="text-muted">{{ $trx->book->penerbit ?? '-' }}</small>
                            </td>
                            <td><i class="bi bi-calendar3 text-muted me-1"></i>{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                            <td class="text-center align-middle">
                                <span class="badge bg-warning text-dark">DIPINJAM</span>
                            </td>
                            <td class="text-center align-middle">
                                <button type="button" class="btn btn-sm btn-success tombol-kembali"
                                    data-bs-toggle="modal" data-bs-target="#konfirmasiModal"
                                    data-id="{{ $trx->id }}"
                                    data-judul="{{ $trx->book->judul_buku ?? 'Buku Dihapus' }}">
                                    <i class="bi bi-arrow-return-left"></i> Kembalikan
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
                @if($activeCount === 0)
                    <tr><td colspan="4" class="text-center py-4 text-muted"><i class="bi bi-check-circle text-success me-2"></i>Tidak ada tanggungan saat ini.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Riwayat Pengembalian -->
<div class="card table-card">
    <div class="card-header d-flex align-items-center gap-2" style="background:#f0fdf4;border-bottom:1px solid #bbf7d0;">
        <i class="bi bi-check-circle text-success"></i>
        <strong>Riwayat Pengembalian</strong>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @php $returnedCount = 0; @endphp
                @foreach($transactions as $trx)
                    @if($trx->status === 'dikembalikan')
                        @php $returnedCount++; @endphp
                        <tr>
                            <td><strong>{{ $trx->book->judul_buku ?? 'Buku Dihapus' }}</strong></td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                            <td class="text-success fw-semibold">{{ \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') }}</td>
                            <td class="text-center"><span class="badge bg-success"><i class="bi bi-check-lg me-1"></i>KEMBALI</span></td>
                        </tr>
                    @endif
                @endforeach
                @if($returnedCount === 0)
                    <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat pengembalian.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.tombol-kembali').forEach(function(btn) {
    btn.addEventListener('click', function() {
        document.getElementById('judul-buku-modal').textContent = this.dataset.judul;
        document.getElementById('form-kembali').action = '/siswa/pengembalian/' + this.dataset.id;
    });
});
</script>
@endsection
