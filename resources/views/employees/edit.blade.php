<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Data Pegawai</h1>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_lengkap">Nama Lengkap:</label><br>
                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $employee->nama_lengkap) }}"required>
            </div>
            <br>

            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}"required>
            </div>
            <br>

            <div>
                <label for="nomor_telepon">Nomor Telepon:</label><br>
                <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon', $employee->nomor_telepon) }}"required>
            </div>
            <br>

            <div>
                <label for="tanggal_lahir">Tanggal Lahir:</label><br>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}"required>
            </div>
            <br>


            <div>
                <label for="alamat">Alamat:</label><br>
                <textarea name="alamat" id="alamat" rows="3" required>{{ old('alamat', $employee->alamat) }}</textarea>
            </div>
            <br>

            <div>
                <label for="tanggal_masuk">Tanggal Masuk:</label><br>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}" required>
            </div>
            <br>

            <div>
                <label for="status">Status:</label><br>
                <select name="status" id="status" required>
                    <option value="Aktif" {{ old('status', $employee->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ old('status', $employee->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <br>

            <button type="submit">update</button>
            <a href="{{ route('employees.index') }}">Batal</a>
        </form>
    </div>
</body>
</html>
