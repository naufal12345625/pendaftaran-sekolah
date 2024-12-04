<?php
session_start();
include '../service/database.php'; // Perbaiki path jika file berada di folder yang berbeda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $tanggal_lahir = trim($_POST['tanggal_lahir']);
    $kelas = trim($_POST['kelas']);
    $alamat = trim($_POST['alamat']);
    $kontak_orangtua = trim($_POST['kontak_orangtua']);

    // Simpan data ke database
    $sql = "INSERT INTO students (nama, tanggal_lahir, kelas, alamat, kontak_orangtua) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $nama, $tanggal_lahir, $kelas, $alamat, $kontak_orangtua);

    if ($stmt->execute()) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href = 'pendaftaran_siswa.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan, coba lagi.'); window.location.href = '../index.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
