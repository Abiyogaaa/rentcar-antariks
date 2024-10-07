<?php
require 'koneksi/koneksi.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
include 'header.php';
$title_web = "RENTAL MOBIL";
?>
<div class="carousel">
    <div class="list">
        <?php
        // Query untuk mengambil semua data mobil
        $sql = "SELECT * FROM mobil ORDER BY id_mobil ASC";
        $row = $koneksi->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();

        // Loop untuk menampilkan data mobil
        foreach ($hasil as $isi) {
        ?>
            <div class="item">
                <!-- Menampilkan gambar mobil dari database (gunakan path gambar yang sesuai dari database) -->
                <img src="images/<?= $isi['gambar'] ?>" alt="<?= $isi['merk'] ?>">

                <!-- Bagian pengenalan singkat mobil -->
                <div class="introduce">
                    <div class="title"><?= $title_web ?></div>
                    <div class="topic"><?= $isi['merk'] ?></div>
                    <div class="dess">
                        <!-- Menampilkan status mobil -->
                        <strong><?= $isi['status'] ?></strong>
                    </div>
                    <button class="seeMore">DETAIL &#8599</button>
                </div>

                <!-- Bagian detail mobil -->
                <div class="detail">
                    <div class="title"><?= $isi['merk'] ?></div>
                    <div class="dess">
                        <?= $isi['deskripsi'] ?>
                    </div>
                    <div class="specifications">
                        <div>
                            <p>Status</p>
                            <p><?= $isi['status'] ?></p>
                        </div>
                        <div>
                            <p>Harga</p>
                            <p>Rp. <?= number_format($isi['harga'], 0, ',', '.') ?></p>
                        </div>
                        <div>
                            <p>Tahun</p>
                            <p><?= $isi['tahun'] ?></p>
                        </div>
                        <div>
                            <p>Promo</p>
                            <p>20%</p>
                        </div>
                        <div>
                            <p>Spesifikasi</p>
                            <p><?= $isi['spesifikasi'] ?></p>
                        </div>
                    </div>
                    <br>
                    <!-- Bagian tombol booking -->
                    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                        <a href="booking.php?id=<?= $isi['id_mobil']; ?>" class="btn btn-primary btn-lg text-uppercase fw-bold px-4 py-2 rounded-pill shadow transition">
                            <i class="fas fa-shopping-cart me-2"></i> Booking Now!
                        </a>
                    </div>

                    <style>
                        .btn {
                            transition: all 0.3s ease;
                            margin-right: 1px;
                        }

                        .btn:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        }

                        .transition {
                            transition: all 0.3s ease;
                        }

                        @media (max-width: 767px) {
                            .btn {
                                width: 100%;
                                margin-bottom: 10px;
                            }
                        }
                    </style>

                </div>
            </div>
        <?php
        } // Akhir loop
        ?>
    </div>
    <div class="arrows">
        <button id="prev">
            < </button>
                <button id="next">></button>
                <button id="back">See All &#8599;</button>
    </div>


    <?php $no++;
    ?>
    <?php include 'footer.php'; ?>
    <script>
        // Menggunakan class agar bisa diterapkan ke banyak tombol
        let kembaliButtons = document.querySelectorAll('.kembali');

        kembaliButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Misalkan carousel adalah elemen yang ingin Anda ubah kelasnya
                let carousel = document.querySelector('.carousel');
                carousel.classList.remove('showDetail');
            });
        });
    </script>