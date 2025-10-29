@extends('master')

@section('page-title', 'Data Gaji Pegawai')
@section('subtitle', 'Riwayat dan pengaturan gaji semua pegawai')

@section('page-action')
<a href="{{ route('salaries.create') }}" class="btn btn-primary">
    <i class="bi bi-plus-circle"></i> Tambah Data Gaji
</a>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-primary">
            <tr>
                <th>Bulan</th>
                <th>Nama Pegawai</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $salary)
            <tr>
                <td>{{ $salary->bulan }}</td>
            <td>{{ $salary->employee->nama_lengkap }}</td>
                <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                <td class="fw-semibold text-primary">Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('salaries.destroy', $salary->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data gaji ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
