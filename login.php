<?php
require 'koneksi/koneksi.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentcar-Antariks | Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="./assets/compiled/css/app.css">
    <link rel="stylesheet" href="./assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="./assets/compiled/css/auth.css">
    <style>
        body {
            background: linear-gradient(135deg, rgb(183, 181, 186), );
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #auth {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }

        .auth-logo img {
            width: 100px;
            height: auto;
            transition: transform 0.3s ease;
        }

        .auth-logo img:hover {
            transform: scale(1.1);
        }

        .auth-title {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
        }

        .auth-subtitle {
            color: #666;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            border-color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .form-check-label {
            color: #666;
        }

        .text-gray-600 {
            color: #666;
        }

        .text-gray-600 a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .text-gray-600 a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="auth-logo text-center mb-4">
            <a href="login.php"><img src="<?php echo $url; ?>images/rentcar.svg" alt="Logo"></a>
        </div>
        <h1 class="auth-title text-center">Log in</h1>
        <p class="auth-subtitle text-center mb-4">Masuk dengan data Anda yang Anda masukkan saat pendaftaran.</p>

        <form method="post" action="koneksi/proses.php?id=login">
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" class="form-control" name="user" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" name="pass" placeholder="Password" required>
                </div>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Biarkan saya tetap masuk
                </label>
            </div>
            <button class="btn btn-primary w-100 mb-3">Log in</button>
        </form>
        <div class="text-center mt-4">
            <p class="text-gray-600">Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#modelId" class="font-bold">Sign up</a>.</p>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header dengan Gradient Background -->
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title">Daftar Pengguna</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body dengan Form -->
                <div class="modal-body">
                    <form method="post" action="koneksi/proses.php?id=daftar">
                        <!-- Floating Labels dengan Animasi -->
                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control floating-input" id="nama" placeholder="Nama Pengguna" required>
                            <label for="nama">Nama Pengguna</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="user" class="form-control floating-input" id="user" placeholder="Username" required>
                            <label for="user">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="pass" class="form-control floating-input" id="pass" placeholder="Password" required>
                            <label for="pass">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control floating-input" id="email" placeholder="Email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="tel" name="notlp" class="form-control floating-input" id="notlp" placeholder="No Telp" required>
                            <label for="notlp">No Telp</label>
                        </div>
                        <!-- Modal Footer dengan Tombol Stylish -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-gradient-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Custom -->
    <style>
        /* Gradient Background untuk Header */
        .bg-gradient-primary {
            background: linear-gradient(135deg, rgb(160, 159, 161));
        }

        /* Efek Shadow untuk Modal */
        .modal-content {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Animasi Floating Label */
        .form-floating label {
            transition: all 0.3s ease;
        }

        .form-floating .floating-input:focus~label,
        .form-floating .floating-input:not(:placeholder-shown)~label {
            transform: translateY(-1.5rem) scale(0.85);
            color: #6a11cb;
        }

        /* Tombol Gradient */
        .btn-gradient-primary {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.4);
        }

        /* Efek Hover pada Tombol Close */
        .btn-outline-secondary:hover {
            background-color: #6a11cb;
            color: white;
            border-color: #6a11cb;
        }

        /* Animasi Modal Saat Muncul */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal.fade .modal-dialog {
            animation: slideIn 0.5s ease-out;
        }
    </style>

    <!-- JavaScript untuk Interaktivitas -->
    <script>
        // Tambahkan efek interaktif saat input aktif
        document.querySelectorAll('.floating-input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', () => {
                if (!input.value) {
                    input.parentElement.classList.remove('focused');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>