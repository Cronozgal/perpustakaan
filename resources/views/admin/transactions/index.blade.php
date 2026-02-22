@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h1><i class="bi bi-arrow-left-right me-2 text-info"></i>Riwayat Transaksi</h1>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Catat Transaksi</a>
</div>

<div class="card table-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIS</th>
                    <th>Nama Anggota</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Buku Dipinjam</th>
                    <th>Tgl. Pinjam</th>
                    <th>Tgl. Kembali</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trx)
                <tr>
                    <td><code>{{ $trx->id }}</code></td>
                    <td>{{ $trx->user->nis ?? '-' }}</td>
                    <td><strong>{{ $trx->user->nama_anggota ?? 'Terhapus' }}</strong></td>
                    <td>{{ $trx->user->kelas ?? '-' }}</td>
                    <td>{{ $trx->user->jurusan ?? '-' }}</td>
                    <td>{{ $trx->book->judul_buku ?? 'Terhapus' }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx->tanggal_pinjam)->format('d M Y') }}</td>
                    <td>
                        @if($trx->tanggal_kembali)
                            <span class="text-success fw-semibold">{{ \Carbon\Carbon::parse($trx->tanggal_kembali)->format('d M Y') }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($trx->status === 'dipinjam')
                            <span class="badge bg-warning text-dark">DIPINJAM</span>
                        @else
                            <span class="badge bg-success">KEMBALI</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('transactions.edit', $trx->id) }}" class="btn btn-sm btn-info text-white me-1"><i class="bi bi-pencil"></i> Edit</a>
                        <form action="{{ route('transactions.destroy', $trx->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center py-5 text-muted"><i class="bi bi-journal-x display-6 d-block mb-2"></i>Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
