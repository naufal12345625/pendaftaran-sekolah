<?php
// Konfigurasi database
$host = "localhost"; // Sesuaikan dengan host Anda
$user = "root"; // Username database
$password = ""; // Password database
$database = "pendaftaran_sekolah"; // Nama database Anda

$conn = new mysqli('localhost', 'root', '', 'pendaftaran_sekolah');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}



?>
