@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Catat Transaksi Baru</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('transactions.index') }}" class="btn btn-sm btn-outline-secondary">Kembali ke Daftar</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Siswa -->
                <div class="col-md-6 mb-3">
                    <label for="user_id" class="form-label">Anggota (Siswa)</label>
                    <select id="user_id" name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_anggota }} (NIS: {{ $user->nis ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Buku -->
                <div class="col-md-6 mb-3">
                    <label for="book_id" class="form-label">Buku yang Dipinjam</label>
                    <select id="book_id" name="book_id" class="form-select @error('book_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                {{ $book->kode_buku }} - {{ $book->judul_buku }}
                            </option>
                        @endforeach
                    </select>
                    @error('book_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <!-- Tanggal Pinjam -->
                <div class="col-md-4 mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" class="form-control @error('tanggal_pinjam') is-invalid @enderror" required>
                    @error('tanggal_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Tanggal Kembali -->
                <div class="col-md-4 mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali <small class="text-muted">(Opsional)</small></label>
                    <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" class="form-control @error('tanggal_kembali') is-invalid @enderror">
                    @error('tanggal_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Status -->
                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status Transaksi</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="dipinjam" {{ old('status', 'dipinjam') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="dikembalikan" {{ old('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Catat Transaksi</button>
            </div>
        </form>
    </div>
</div>
@endsection
