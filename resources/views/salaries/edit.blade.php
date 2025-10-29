@extends('master')

@section('page-title', 'Edit Data Gaji')
@section('subtitle', 'Perbarui data gaji pegawai')

@section('page-action')
<a href="{{ route('salaries.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left-circle"></i> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('salaries.update', $salary->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nama Pegawai</label>
        <input type="hidden" name="karyawan_id" value="{{ $salary->employee->id }}">
        <input type="text" class="form-control" value="{{ $salary->employee->nama_lengkap }}" disabled>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Bulan</label>
            <input type="month" name="bulan" class="form-control" value="{{ $salary->bulan }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" class="form-control" value="{{ $salary->gaji_pokok }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tunjangan / Bonus</label>
            <input type="number" name="tunjangan" class="form-control" value="{{ $salary->tunjangan }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Potongan</label>
            <input type="number" name="potongan" class="form-control" value="{{ $salary->potongan }}">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Perbarui</button>
</form>
@endsection
