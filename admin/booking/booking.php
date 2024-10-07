<?php

require '../../koneksi/koneksi.php';
$title_web = 'Daftar Booking';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
$search = '';
if (!empty($_GET['search'])) {
    $search = strip_tags($_GET['search']);
}

// Mengubah query SQL untuk memasukkan pencarian
if (!empty($_GET['id'])) {
    $id = strip_tags($_GET['id']);
    $sql = "SELECT mobil.merk, booking.* FROM booking 
            JOIN mobil ON booking.id_mobil=mobil.id_mobil 
            WHERE id_login = '$id' 
            AND (kode_booking LIKE '%$search%' 
            OR mobil.merk LIKE '%$search%' 
            OR booking.nama LIKE '%$search%' 
            OR booking.tanggal LIKE '%$search%' 
            OR booking.lama_sewa LIKE '%$search%' 
            OR total_harga LIKE '%$search%' 
            OR konfirmasi_pembayaran LIKE '%$search%') 
            ORDER BY id_booking DESC";
} else {
    $sql = "SELECT mobil.merk, booking.* FROM booking 
            JOIN mobil ON booking.id_mobil=mobil.id_mobil 
            WHERE (kode_booking LIKE '%$search%' 
            OR mobil.merk LIKE '%$search%' 
            OR booking.nama LIKE '%$search%' 
            OR booking.tanggal LIKE '%$search%' 
            OR booking.lama_sewa LIKE '%$search%' 
            OR total_harga LIKE '%$search%' 
            OR konfirmasi_pembayaran LIKE '%$search%') 
            ORDER BY id_booking DESC";
}

$hasil = $koneksi->query($sql)->fetchAll();
$total_harga = 0;
?>

<style>
    /* Mengurangi padding dan ukuran font di tabel */
    .table-sm th,
    .table-sm td {
        padding: 0.3rem;
        /* Mengurangi padding sel */
        font-size: 0.85rem;
        /* Mengurangi ukuran font */
    }

    /* Mengurangi margin di tombol agar tabel lebih ringkas */
    .table-sm .btn {
        padding: 0.25rem 0.5rem;
        /* Mengurangi padding tombol */
        font-size: 0.75rem;
        /* Mengurangi ukuran font tombol */
    }

    /* Membuat kolom lebih sempit agar konten lebih kompak */
    .table-sm th,
    .table-sm td {
        white-space: nowrap;
        /* Membuat konten dalam satu baris */
        text-align: center;
        /* Menyelaraskan teks di tengah */
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {

        .table-sm th,
        .table-sm td {
            font-size: 0.75rem;
            /* Ukuran font lebih kecil untuk layar kecil */
        }
    }
</style>
<br>
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3><?= $title_web ?></h3>
</div>
<div class="container">
    <div class="card">
        <div class="card-header text-white bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <form method="GET" action="" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Cari..." value="<?= htmlspecialchars($search); ?>" style="width: auto;">
                    <button type="submit" class="btn btn-outline-light d-flex align-items-center">
                        <i data-feather="search" class="me-1"></i>Cari
                    </button>
                </form>
                <a class="btn btn-outline-light d-flex align-items-center" href="cetakbooking.php" role="button">
                    <i data-feather="printer" class="me-1"></i>Cetak
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Booking</th>
                            <th>Merk Mobil</th>
                            <th>Nama </th>
                            <th>Tanggal Sewa </th>
                            <th>Lama Sewa </th>
                            <th>Total Harga</th>
                            <th>Konfirmasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($hasil as $isi) {
                            $total_harga += $isi['total_harga'];
                        ?>
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
                                    <a class="btn btn-primary" href="bayar.php?id=<?= $isi['kode_booking']; ?>"
                                        role="button">Detail</a>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="alert alert-primary">
            <strong>Total Keseluruhan:</strong> Rp. <?= number_format($total_harga); ?>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>