<?php
session_start();
include '../service/database.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != TRUE) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Selamat Datang di Dashboard Admin</h1>
        <div class="mt-4">
            <p>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>! Anda sedang berada di dashboard admin.</p>
            <div class="text-center">
                <a href="manage_student.php" class="btn btn-primary">Kelola Data Siswa</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
