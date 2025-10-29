@extends('master')

@section('page-title', 'Edit Pegawai')
@section('subtitle', 'Perbarui data pegawai dan absensi di bawah ini')

@section('page-action')
<a href="{{ route('employees.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('employees.update', $employee->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <h5 class="fw-bold text-primary mb-3">Data Pegawai</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control"
                value="{{ old('nama_lengkap', $employee->nama_lengkap) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control"
                value="{{ old('email', $employee->email) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control"
                value="{{ old('nomor_telepon', $employee->nomor_telepon) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control"
                value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Departemen</label>
            <select name="departemen_id" class="form-select" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ $employee->departemen_id == $dept->id ? 'selected' : '' }}>
                        {{ $dept->nama_departemen }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Jabatan</label>
            <select name="jabatan_id" class="form-select" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}" {{ $employee->jabatan_id == $pos->id ? 'selected' : '' }}>
                        {{ $pos->nama_jabatan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $employee->alamat) }}</textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control"
                value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Status Pegawai</label>
            <select name="status" class="form-select">
                <option value="aktif" {{ $employee->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $employee->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold text-primary mb-3">Data Absensi (Manual)</h5>
    <p class="text-muted mb-3" style="font-size: 0.9rem;">Isi jika ingin menambahkan atau memperbarui absensi pegawai ini.</p>

    <div class="row">
        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Tanggal Absen</label>
            <input type="date" name="tanggal_absen" class="form-control" value="{{ old('tanggal_absen') }}">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Waktu Masuk</label>
            <input type="time" name="waktu_masuk" class="form-control" value="{{ old('waktu_masuk') }}">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Waktu Keluar</label>
            <input type="time" name="waktu_keluar" class="form-control" value="{{ old('waktu_keluar') }}">
        </div>

        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Status Absensi</label>
            <select name="status_absensi" class="form-select">
                <option value="">-- Pilih Status --</option>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>
    </div>

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-warning px-4">
            <i class="bi bi-save me-1"></i> Perbarui
        </button>
    </div>
</form>
@endsection
