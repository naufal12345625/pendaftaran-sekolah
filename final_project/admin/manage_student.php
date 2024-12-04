<?php
session_start();
include '../service/database.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != TRUE) {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil data siswa dari database
$sql = "SELECT * FROM students ORDER BY tanggal_pendaftaran DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Kelola Data Siswa</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Kelola Data Siswa</h1>
        <div class="mt-4">
            <?php if ($result->num_rows > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                        <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>kelas</th>
                    <th>alamat</th>
                    <th>kontak orangtua</th>
                    <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                            <td><?= htmlspecialchars($row['alamat']); ?></td>
                            <td><?= htmlspecialchars($row['kontak_orangtua']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_pendaftaran']); ?></td>
                                <td>
                                    <a href="edit_student.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="crud.php?id=<?= $row['id']; ?>&action=delete" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">Belum ada data siswa.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
