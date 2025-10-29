@extends('master')

@section('page-title', 'Departemen')
@section('subtitle', 'Kelola daftar departemen di perusahaan')

@section('page-action')
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold text-primary mb-3">Tambah Departemen Baru</h5>
        <form action="{{ route('departments.store') }}" method="POST" class="needs-validation" novalidate>
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
                <div class="col-md-10 mb-2">
                    <label class="form-label fw-semibold">Nama Departemen</label>
                    <input type="text" name="nama_departemen" class="form-control" placeholder="Masukkan nama departemen" required>
                </div>
                <div class="col-md-2 mb-2 text-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle me-1"></i> Tambah
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold text-primary mb-3">Daftar Departemen</h5>

        @if($departments->isEmpty())
            <p class="text-muted mb-0">Belum ada departemen yang terdaftar.</p>
        @else
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th style="width:5%">#</th>
                        <th>Nama Departemen</th>
                        <th style="width:15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $d)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <form action="{{ route('departments.update', $d->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nama_departemen" value="{{ $d->nama_departemen }}" class="form-control form-control-sm" required>
                                <button type="submit" class="btn btn-sm btn-success" title="Simpan Perubahan">
                                    <i class="bi bi-save"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('departments.destroy', $d->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus departemen ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Departemen">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
