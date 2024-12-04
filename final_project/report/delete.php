<?php
require_once '../service/database.php';

// Cek apakah ID dikirim melalui URL
if (!isset($_GET['id'])) {
    die('ID tidak ditemukan.');
}

$id = intval($_GET['id']);

// Hapus data berdasarkan ID
$sql_delete = "DELETE FROM students WHERE id = ?";
$stmt = $conn->prepare($sql_delete);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header('Location: ../auth/pendaftaran_siswa.php');
    exit;
} else {
    echo 'Gagal menghapus data.';
}
?>
