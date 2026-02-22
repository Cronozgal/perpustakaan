@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h1><i class="bi bi-journal-text me-2 text-primary"></i>Data Buku</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Tambah Buku</a>
</div>

<div class="card table-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td><code>{{ $book->kode_buku }}</code></td>
                    <td><strong>{{ $book->judul_buku }}</strong></td>
                    <td>{{ $book->pengarang }}</td>
                    <td>{{ $book->penerbit }}</td>
                    <td><span class="badge bg-secondary-subtle text-secondary">{{ $book->tahun }}</span></td>
                    <td class="text-center">
                        @if($book->stok > 0)
                            <span class="badge bg-success-subtle text-success">{{ $book->stok }}</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger">Habis</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i> Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-journal-x display-6 d-block mb-2"></i>Belum ada data buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
