@extends('master')

@section('page-title', 'Jabatan')
    
@section('page-action')
@endsection

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <h5 class="fw-bold text-primary mb-3">Tambah Jabatan Baru</h5>

        <form action="{{ route('positions.store') }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <strong><i class="bi bi-exclamation-triangle-fill"></i> Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row align-items-end">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nama Jabatan</label>
                <input type="text" name="nama_jabatan" class="form-control" value="{{ old('nama_jabatan') }}" placeholder="Masukkan nama jabatan" required>
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-plus-circle me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif
    </div>
</div>

<hr class="my-4">

<h5 class="fw-bold text-primary mb-3">Daftar Jabatan</h5>

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th style="width: 5%">#</th>
                <th>Nama Jabatan</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($positions as $p)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    <form action="{{ route('positions.update', $p->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                        @csrf
                        @method('PUT')
                        <input type="text" name="nama_jabatan" value="{{ $p->nama_jabatan }}" class="form-control form-control-sm">
                        <button class="btn btn-sm btn-success" title="Simpan Perubahan">
                            <i class="bi bi-save"></i>
                        </button>
                    </form>
                </td>
                <td class="text-center">
                    <form action="{{ route('positions.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">Belum ada data jabatan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
