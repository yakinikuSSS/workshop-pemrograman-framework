<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Form Pegawai</h1>

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div>
                <label for="nama_lengkap">Nama Lengkap:</label><br>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required>
            </div>
            <br>

            <div>
                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required>
            </div>
            <br>

            <div>
                <label for="nomor_telepon">Nomor Telepon:</label><br>
                <input type="text" name="nomor_telepon" id="nomor_telepon" required>
            </div>
            <br>

            <div>
                <label for="tanggal_lahir">Tanggal Lahir:</label><br>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>
            <br>


            <div>
                <label for="alamat">Alamat:</label><br>
                <textarea name="alamat" id="alamat" rows="3" required></textarea>
            </div>
            <br>

            <div>
                <label for="tanggal_masuk">Tanggal Masuk:</label><br>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" required>
            </div>
            <br>

            <div>
                <label for="status">Status:</label><br>
                <select name="status" id="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
            <br>

            <button type="submit">Simpan</button>
            <a href="{{ route('employees.index') }}">Batal</a>
        </form>
    </div>
</body>
</html>
