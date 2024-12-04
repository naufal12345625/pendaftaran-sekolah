<?php
session_start();
require_once '../service/database.php';

// Periksa apakah pengguna adalah admin
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] != TRUE) {
    header('Location: ../index.php');
    exit();
}

// Tangkap ID dan aksi
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];
if ($action == 'delete') {
        // Hapus akun
        $query = "DELETE FROM students WHERE id = $id";
        if($conn->query($query)) {
            header('Location: ../admin/index.php');
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($connection);
        }
    } else {
        echo "Invalid action.";
    }
} else {
    echo "ID or action not provided.";
}
?>
