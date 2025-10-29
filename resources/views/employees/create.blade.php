@extends('master')

@section('page-title', 'Tambah Pegawai')
@section('subtitle', 'Isi data pegawai baru di bawah ini')

@section('page-action')
<a href="{{ route('employees.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
</a>
@endsection

@section('content')
<form action="{{ route('employees.store') }}" method="POST" class="needs-validation" novalidate>
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

    <h5 class="fw-bold text-primary mb-3">Data Pegawai</h5>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" placeholder="contoh: nama@email.com" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Departemen</label>
            <select name="departemen_id" class="form-select" required>
                <option value="">-- Pilih Departemen --</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->nama_departemen }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Jabatan</label>
            <select name="jabatan_id" class="form-select" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $pos)
                    <option value="{{ $pos->id }}">{{ $pos->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label fw-semibold">Alamat</label>
            <textarea name="alamat" rows="2" class="form-control" placeholder="Masukkan alamat lengkap" required></textarea>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold">Status Pegawai</label>
            <select name="status" class="form-select">
                <option value="aktif" selected>Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold text-primary mb-3">Data Absensi (Opsional)</h5>
    <p class="text-muted mb-3" style="font-size: 0.9rem;">Isi bagian ini jika ingin menambahkan catatan absensi secara manual.</p>

    <div class="row">
        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Tanggal Absen</label>
            <input type="date" name="tanggal_absen" class="form-control">
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Waktu Masuk</label>
            <input type="time" name="waktu_masuk" class="form-control">
        </div>
        <div class="col-md-3 mb-3">
            <label class="form-label fw-semibold">Waktu Keluar</label>
            <input type="time" name="waktu_keluar" class="form-control">
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
    </script>
    <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-save me-1"></i> Simpan
        </button>
    </div>
</form>
@endsection
