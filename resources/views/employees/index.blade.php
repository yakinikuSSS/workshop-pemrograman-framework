<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @extends('master')

    @section('title', 'Daftar Pegawai')
    @section('page-title', 'Daftar Pegawai')
    @section('subtitle', 'Kelola data pegawai dengan mudah')

    @section('page-action')
    <a href="{{ route('employees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Pegawai
    </a>
    @endsection

    @section('content')
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->nama_lengkap }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->nomor_telepon }}</td>
                    <td>{{ $employee->department->nama_departemen ?? '-' }}</td>
                    <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                    <td>{{ $employee->tanggal_masuk }}</td>
                    <td>
                        <span class="badge bg-{{ $employee->status == 'aktif' ? 'success' : 'secondary' }}">
                            {{ ucfirst($employee->status) }}
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus pegawai ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $employees->links() }}
    </div>
    @endsection
</body>
</html>