<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AULIA.RENTCAR</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <style>
        .navbar {
            z-index: 9999;
        }

        .navbar-bold {
            font-weight: bold;
            /* Menebalkan teks */
            padding: 10px 20px;
            /* Menambahkan ruang pada tombol navbar */
            font-size: 1.1rem;
            /* Meningkatkan ukuran teks sedikit */
            letter-spacing: 0.5px;
            /* Memberi sedikit jarak antara huruf */
            transition: all 0.3s ease;
            /* Efek transisi saat di-hover */
        }

        .navbar-bold:hover {
            background-color: #f8f9fa;
            /* Memberikan efek hover (opsional) */
            color: #007bff;
            /* Ubah warna teks saat di-hover */
            border-radius: 5px;
            /* Opsional, untuk memberi sudut */
        }

        .active {
            color: #007bff;
            /* Warna untuk halaman aktif */
            font-weight: 700;
            /* Menebalkan teks pada halaman aktif */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="index.php">AULIA.RENTCAR</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse debug-navbar" id="navbarNav">
                <hr>
                <ul class="navbar-nav ml-auto">
                    <ul class="navbar-nav my-2 my-lg-0">
                        <?php
                        // Mendapatkan nama file halaman saat ini
                        $current_page = basename($_SERVER['PHP_SELF']);
                        ?>

                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'index.php') echo 'active'; ?> <?php if ($current_page == 'booking.php') echo 'active'; ?><?php if ($current_page == 'bayar.php') echo 'active'; ?>" href="index.php" class="mx-2 text-dark" style="position: relative; z-index: 10;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'daftarmobil.php') echo 'active'; ?>" href="daftarmobil.php">Daftar Mobil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($current_page == 'kontak.php') echo 'active'; ?>" href="kontak.php" class="mx-2 text-dark" style="position: relative; z-index: 10;">Kontak Kami</a>
                        </li>
                        <?php if (!empty($_SESSION['USER'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#historyModal">History</a>
                            </li>

                            <!-- Modal History -->
                            <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="historyModalLabel">History Transaksi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Booking</th>
                                                        <th>Merk Mobil</th>
                                                        <th>Nama</th>
                                                        <th>Tanggal Sewa</th>
                                                        <th>Lama Sewa</th>
                                                        <th>Total Harga</th>
                                                        <th>Konfirmasi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    session_start();
                                                    require 'koneksi/koneksi.php';

                                                    if (empty($_SESSION['USER'])) {
                                                        echo '<script>alert("Harap Login");window.location="index.php"</script>';
                                                    }
                                                    $hasil = $koneksi->query("SELECT mobil.merk, booking.* FROM booking JOIN mobil ON 
                                                     booking.id_mobil=mobil.id_mobil ORDER BY id_booking DESC")->fetchAll();
                                                    $no = 1;
                                                    foreach ($hasil as $isi) { ?>
                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?= $isi['kode_booking']; ?></td>
                                                            <td><?= $isi['merk']; ?></td>
                                                            <td><?= $isi['nama']; ?></td>
                                                            <td><?= $isi['tanggal']; ?></td>
                                                            <td><?= $isi['lama_sewa']; ?> hari</td>
                                                            <td>Rp. <?= number_format($isi['total_harga']); ?></td>
                                                            <td><?= $isi['konfirmasi_pembayaran']; ?></td>
                                                            <td>
                                                                <a class="btn btn-primary btn-sm" href="bayar.php?id=<?= $isi['kode_booking']; ?>" role="button">Detail</a>
                                                            </td>
                                                        </tr>
                                                    <?php $no++;
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Link untuk membuka modal -->
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#profileModal">
                                <i class="fa fa-user"></i> <?php echo $_SESSION['USER']['nama_pengguna']; ?>
                            </a>

                            <!-- Modal Profil Pengguna -->
                            <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="nama_pengguna">Nama Pengguna : <?php echo $_SESSION['USER']['nama_pengguna']; ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Username : <?php echo $_SESSION['USER']['username']; ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email : <?php echo $_SESSION['USER']['email']; ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label for="notlp">Nomor Telepon : <?php echo $_SESSION['USER']['notlp']; ?></label>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="logoutButton" href="#">Logout</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link <?php if ($current_page == 'login.php') echo 'active'; ?>" href="login.php" class="mx-2 text-dark" style="position: relative; z-index: 10;">Login</a>
                            </li>
                        <?php } ?>
                    </ul>


                </ul>
            </div>
        </div>
    </nav>