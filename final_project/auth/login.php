<?php
session_start();
require_once '../service/database.php'; // Pastikan path benar

if (isset($_POST['login'])) {
    // Ambil input dengan sanitasi
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Pastikan koneksi ke database berhasil
    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    // Gunakan prepared statement untuk keamanan
    $query = "SELECT * FROM akun WHERE username = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verifikasi password menggunakan password_verify()
            if (password_verify($password, $row['password'])) {
                // Login berhasil, buat sesi
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row['id'];
                $_SESSION['is_logged_in'] = TRUE;

                // Redirect ke halaman awal
                header('Location: ../index.php');
                exit();
            } else {
                $error = "Password salah. Silakan coba lagi.";
            }
        } else {
            $error = "Username tidak ditemukan. Silakan coba lagi.";
        }

        $stmt->close();
    } else {
        $error = "Terjadi kesalahan pada sistem. Silakan coba lagi nanti.";
    }
}

// Tutup koneksi database saat script selesai
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-success {
            background-color: #2575fc;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #6a11cb;
            transform: scale(1.05);
        }

        .btn-home {
            background-color: #6c757d;
            color: white;
            border: none;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-home:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-4">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-success btn-lg">Login</button>
                            </div>
                        </form>
                        <div class="d-grid mt-3">
                            <button class="btn btn-home btn-lg" onclick="location.href='../index.php'">Halaman Awal</button>
                        </div>
                    </div>
                    <div class="card-footer text-center text-muted py-3">
                        Belum punya akun? <a href="../auth/register.php" class="text-decoration-none" style="color: #2575fc;">Daftar di sini</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
