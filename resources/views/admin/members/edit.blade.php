@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Data Anggota</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('members.index') }}" class="btn btn-sm btn-outline-secondary">Kembali ke Daftar</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('members.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- NIS -->
                <div class="col-md-6 mb-3">
                    <label for="nis" class="form-label">Nomor Induk Siswa (NIS)</label>
                    <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis', $member->nis) }}" autofocus>
                    @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Nama Lengkap -->
                <div class="col-md-6 mb-3">
                    <label for="nama_anggota" class="form-label">Nama Lengkap Siswa</label>
                    <input type="text" class="form-control @error('nama_anggota') is-invalid @enderror" id="nama_anggota" name="nama_anggota" value="{{ old('nama_anggota', $member->nama_anggota) }}" required>
                    @error('nama_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <!-- Kelas -->
                <div class="col-md-6 mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <input type="text" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas', $member->kelas) }}">
                    @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Jurusan -->
                <div class="col-md-6 mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan', $member->jurusan) }}">
                    @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr>
            <h5 class="mb-3">Informasi Akun</h5>
            <div class="row">
                <!-- Username -->
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $member->username) }}" required>
                    @error('username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <!-- Password -->
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" minlength="6">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('members.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-warning">Update Anggota</button>
            </div>
        </form>
    </div>
</div>
@endsection
