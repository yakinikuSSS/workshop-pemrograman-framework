@extends('master')

@section('page-title', 'Detail Pegawai')
@section('subtitle', 'Informasi lengkap pegawai beserta absensi dan riwayat gaji')

@section('page-action')
<a href="{{ route('employees.index') }}" class="btn btn-secondary">
    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
</a>
@endsection

@section('content')

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-primary text-white fw-semibold">
        Data Pegawai
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle mb-0">
                <tr><th width="25%">Nama Lengkap</th><td>{{ $employee->nama_lengkap }}</td></tr>
                <tr><th>Email</th><td>{{ $employee->email }}</td></tr>
                <tr><th>Nomor Telepon</th><td>{{ $employee->nomor_telepon }}</td></tr>
                <tr><th>Departemen</th><td>{{ $employee->department->nama_departemen ?? '-' }}</td></tr>
                <tr><th>Jabatan</th><td>{{ $employee->position->nama_jabatan ?? '-' }}</td></tr>
                <tr><th>Tanggal Lahir</th><td>{{ $employee->tanggal_lahir }}</td></tr>
                <tr><th>Alamat</th><td>{{ $employee->alamat }}</td></tr>
                <tr><th>Tanggal Masuk</th><td>{{ $employee->tanggal_masuk }}</td></tr>
                <tr><th>Status</th>
                    <td>
                        <span class="badge bg-{{ $employee->status == 'aktif' ? 'success' : 'secondary' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-primary text-white fw-semibold">
        Riwayat Absensi
    </div>
    <div class="card-body">
        @if($employee->attendances->isEmpty())
            <p class="text-muted mb-0">Belum ada data absensi untuk pegawai ini.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Status Absensi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee->attendances as $att)
                        <tr>
                            <td>{{ $att->tanggal }}</td>
                            <td>{{ $att->waktu_masuk ?? '-' }}</td>
                            <td>{{ $att->waktu_keluar ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $att->status_absensi === 'hadir' ? 'success' : 
                                    ($att->status_absensi === 'izin' ? 'info' :
                                    ($att->status_absensi === 'sakit' ? 'warning' : 'danger'))
                                }}">
                                    {{ ucfirst($att->status_absensi) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('attendance.editAttendance', $att->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('attendance.deleteAttendance', $att->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus absensi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
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

<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white fw-semibold">
        Riwayat Gaji
    </div>
    <div class="card-body">
        @if($employee->salaries->isEmpty())
            <p class="text-muted mb-0">Belum ada data gaji untuk pegawai ini.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>Bulan</th>
                        <th>Gaji Pokok</th>
                        <th>Tunjangan</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employee->salaries as $salary)
                    <tr>
                        <td>{{ $salary->bulan }}</td>
                        <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                        <td class="fw-semibold text-primary">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
