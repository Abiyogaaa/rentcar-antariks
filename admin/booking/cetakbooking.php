<?php
require '../../koneksi/koneksi.php';
$title_web = 'Cetak Daftar Booking';
include '../header.php';

if (empty($_SESSION['USER'])) {
    session_start();
}

// Ambil data booking
if (!empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = "SELECT mobil.merk, booking.* FROM booking JOIN mobil ON 
                booking.id_mobil=mobil.id_mobil WHERE id_login = '$id' ORDER BY id_booking DESC";
} else {
    $sql = "SELECT mobil.merk, booking.* FROM booking JOIN mobil ON 
                booking.id_mobil=mobil.id_mobil ORDER BY id_booking DESC";
}
$hasil = $koneksi->query($sql)->fetchAll();
?>

<div class="container mt-4">
    <h2 class="text-center">Daftar Booking Mobil</h2>
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
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
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
                </tr>
            <?php $no++;
            } ?>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
        <a href="bo.php" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }

        .container {
            margin: 0;
            padding: 0;
        }

        .btn {
            display: none;
            /* Sembunyikan tombol saat mencetak */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #000;
        }
    }
</style>

<?php include '../footer.php'; ?>