@extends('layouts.app')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <h1><i class="bi bi-people me-2 text-success"></i>Data Anggota Siswa</h1>
    <a href="{{ route('members.create') }}" class="btn btn-success"><i class="bi bi-person-plus me-1"></i> Daftarkan Anggota</a>
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
                    <th>Username</th>
                    <th>Password</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td><code>{{ $member->id }}</code></td>
                    <td>{{ $member->nis ?: '-' }}</td>
                    <td><strong>{{ $member->nama_anggota }}</strong></td>
                    <td>{{ $member->kelas ?: '-' }}</td>
                    <td>{{ $member->jurusan ?: '-' }}</td>
                    <td>{{ $member->username }}</td>
                    <td><span class="text-muted fst-italic small">(terenkripsi)</span></td>
                    <td class="text-center">
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i> Edit</a>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-5 text-muted"><i class="bi bi-people display-6 d-block mb-2"></i>Belum ada anggota terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
