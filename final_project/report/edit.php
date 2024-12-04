<?php
require_once '../service/database.php';

// Cek apakah ID dikirim melalui URL
if (!isset($_GET['id'])) {
    die('ID tidak ditemukan.');
}

$id = intval($_GET['id']);

// Ambil data siswa berdasarkan ID
$sql = "SELECT * FROM students WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die('Data siswa tidak ditemukan.');
}

$row = $result->fetch_assoc();

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $kontak_orangtua = $_POST['kontak_orangtua'];

    $sql_update = "UPDATE students SET nama = ?, kelas = ?, alamat = ?, kontak_orangtua = ? WHERE id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param('ssssi', $nama, $kelas, $alamat, $kontak_orangtua, $id);

    if ($stmt->execute()) {
        header('Location: ../auth/pendaftaran_siswa.php');
        exit;
    } else {
        echo 'Gagal mengupdate data.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Data Siswa</h1>
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?= htmlspecialchars($row['nama']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" id="kelas" name="kelas" class="form-control" value="<?= htmlspecialchars($row['kelas']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" required><?= htmlspecialchars($row['alamat']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="kontak_orangtua" class="form-label">Kontak Orangtua</label>
                <input type="text" id="kontak_orangtua" name="kontak_orangtua" class="form-control" value="<?= htmlspecialchars($row['kontak_orangtua']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../auth/pendaftaran_siswa.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
