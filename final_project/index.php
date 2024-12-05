<?php
session_start();
include 'service/database.php'; // Perbaiki path jika file berada di folder yang berbeda

// Cek apakah pengguna sudah login dan merupakan admin
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulir Pendaftaran Sekolah</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: linear-gradient(90deg, #42a5f5, #478ed1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }

        .form-section {
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
        }

        footer {
            background-color: #424242;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 30px;
        }

        footer a {
            color: #ffb74d;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #ffa726;
        }

        @media (max-width: 768px) {
            .form-section {
                padding: 15px;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            footer {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            .form-section {
                margin-top: 20px;
            }

            footer {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sekolah Cerdas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="auth/login.php">Login Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/dashboard.php">dashboard admin (admin only)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/pendaftaran_siswa.php">Lihat Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="auth/logout.php">Logout Admin</a>
                    </li>
                    <?php if ($is_admin): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/dashboard.php">Admin Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin/manage_students.php">Kelola Siswa</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Form Section -->
    <div class="container">
        <div class="form-section">
            <h2 class="text-center mb-4">Formulir Pendaftaran Sekolah</h2>
            <form action="auth/process_registration_user.php" method="post"> <!-- Perbaiki path ke process_registration.php -->
                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap Siswa</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
                </div>

                <!-- Kelas Tujuan -->
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas yang Dituju</label>
                    <select name="kelas" id="kelas" class="form-select" required>
                        <option value="">Pilih kelas</option>
                        <option value="1">Kelas 1</option>
                        <option value="2">Kelas 2</option>
                        <option value="3">Kelas 3</option>
                        <option value="4">Kelas 4</option>
                        <option value="5">Kelas 5</option>
                        <option value="6">Kelas 6</option>
                    </select>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <!-- Nomor Telepon Orang Tua -->
                <div class="mb-3">
                    <label for="kontak_orangtua" class="form-label">Nomor Telepon Orang Tua</label>
                    <input type="tel" name="kontak_orangtua" id="kontak_orangtua" class="form-control" placeholder="Masukkan nomor telepon" required>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Sekolah Cerdas. All Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Contact</a></p>
        <p>Cara mendaftarkan siswa Anda: Admin dapat login melalui halaman <a href="auth/login.php">Login Admin</a> untuk mengelola data siswa. Pengguna lainnya tidak perlu login dan dapat langsung mengisi formulir di atas.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
