<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Pegawai</h2>
        <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Nama Lengkap</td>
                <td><input type="text" name="nama_lengkap"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td><input type="text" name="nomor_telepon"></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="date" name="tanggal_lahir"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat"></td>
            </tr>
            <tr>
                <td>Tanggal Masuk</td>
                <td><input type="date" name="tanggal_masuk"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="status">Status:</label><br>
                    <select name="status" id="status" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>                
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Simpan</button>
                    <button type="button" onclick="window.location.href ='{{ route('employees.index') }}'">Batal</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>