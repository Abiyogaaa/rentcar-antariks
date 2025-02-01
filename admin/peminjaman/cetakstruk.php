<?php
require '../../koneksi/koneksi.php';

if (empty($_GET['id'])) {
    die('Kode booking tidak valid');
}

$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

if (!$hasil) {
    die('Data booking tidak ditemukan');
}

$id_booking = $hasil['id_booking'];
$hsl = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->fetch();
$id = $hasil['id_mobil'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Penyewaan Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                width: 80mm;
                margin: 0 auto;
                font-family: monospace;
            }

            .print-container {
                border: 1px dashed #000;
                padding: 15px;
            }
        }

        @media screen {
            .print-container {
                max-width: 400px;
                margin: 20px auto;
                border: 1px solid #ddd;
                padding: 15px;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="print-container text-center">
            <h4 class="mb-4">STRUK RENTAL MOBIL</h4>

            <div class="text-start">
                <p class="mb-2"><strong>Kode Booking:</strong> <?= htmlspecialchars($hasil['kode_booking']); ?></p>
                <p class="mb-2"><strong>Nama Penyewa:</strong> <?= htmlspecialchars($hasil['nama']); ?></p>
                <p class="mb-2"><strong>No. Telepon:</strong> <?= htmlspecialchars($hasil['no_tlp']); ?></p>
                <hr>
                <p class="mb-2"><strong>Mobil:</strong> <?= htmlspecialchars($isi['merk']); ?></p>
                <p class="mb-2"><strong>No. Plat:</strong> <?= htmlspecialchars($isi['no_plat']); ?></p>
                <p class="mb-2"><strong>Tanggal Sewa:</strong> <?= htmlspecialchars($hasil['tanggal']); ?></p>
                <p class="mb-2"><strong>Lama Sewa:</strong> <?= htmlspecialchars($hasil['lama_sewa']); ?> Hari</p>
                <hr>
                <p class="mb-2"><strong>Harga/Hari:</strong> Rp. <?= number_format($isi['harga']); ?></p>
                <p class="mb-2"><strong>Total Harga:</strong> Rp. <?= number_format($hasil['total_harga']); ?></p>
            </div>

            <hr>
            <p class="text-muted small">Terima Kasih</p>
        </div>
    </div>
</body>

</html>