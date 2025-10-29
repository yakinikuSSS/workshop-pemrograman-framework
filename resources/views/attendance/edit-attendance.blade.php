@extends('master')

@section('page-title', 'Edit Absensi')
@section('subtitle', 'Perbarui data absensi pegawai')

@section('page-action')
<a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left"></i> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('attendance.updateAttendance', $attendance->id) }}" method="POST" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label fw-semibold">Nama Pegawai</label>
        <input type="text" class="form-control" value="{{ $employee->nama_lengkap }}" disabled>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" value="{{ $attendance->tanggal }}" required>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Waktu Masuk</label>
            <input type="time" name="waktu_masuk" class="form-control" value="{{ $attendance->waktu_masuk }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Waktu Keluar</label>
            <input type="time" name="waktu_keluar" class="form-control" value="{{ $attendance->waktu_keluar }}">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Absensi</label>
        <select name="status_absensi" class="form-select">
            <option value="hadir" {{ $attendance->status_absensi == 'hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="izin" {{ $attendance->status_absensi == 'izin' ? 'selected' : '' }}>Izin</option>
            <option value="sakit" {{ $attendance->status_absensi == 'sakit' ? 'selected' : '' }}>Sakit</option>
            <option value="alpha" {{ $attendance->status_absensi == 'alpha' ? 'selected' : '' }}>Alpha</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> Simpan Perubahan
    </button>
</form>
@endsection
