@extends('master')

@section('page-title', 'Tambah Data Gaji')
@section('subtitle', 'Masukkan data gaji baru untuk pegawai')

@section('page-action')
<a href="{{ route('salaries.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left-circle"></i> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('salaries.store') }}" method="POST">
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

    <div class="mb-3">
        <label class="form-label">Pilih Pegawai</label>
        <select name="karyawan_id" class="form-select" required>
            <option value="">-- Pilih Pegawai --</option>
            @foreach ($employees as $emp)
            <option value="{{ $emp->id }}">{{ $emp->nama_lengkap }}</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Bulan</label>
            <input type="month" name="bulan" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" class="form-control" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tunjangan / Bonus</label>
            <input type="number" name="tunjangan" class="form-control" value="0">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Potongan</label>
            <input type="number" name="potongan" class="form-control" value="0">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
