<?php

require '../../koneksi/koneksi.php';
$title_web = 'Daftar Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

$status = "Tersedia";
$sql = "SELECT * FROM mobil WHERE status = ?";
$row = $koneksi->prepare($sql);
$row->execute([$status]);
$dataMobil = $row->fetchAll();

?>

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
                <h4 class="card-title">
                    <?php
                    echo "Jumlah Mobil Tersedia: " . count($dataMobil);
                    ?>

                </h4>
                <div>
                    <a class="btn btn-outline-light d-flex align-items-center" href="tambah.php" role="button"><i data-feather="edit" class="me-1"></i>Tambah</a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <table id="mobilTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>Merk Mobil</th>
                        <th>No Plat</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Tahun</th>
                        <th>Kapasitas</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM mobil ORDER BY id_mobil ASC";
                    $row = $koneksi->prepare($sql);
                    $row->execute();
                    $hasil = $row->fetchAll();
                    $no = 1;

                    foreach ($hasil as $isi) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><img src="../../images/<?php echo $isi['gambar']; ?>" class="img-fluid" style="width: 100px;"></td>
                            <td><?php echo $isi['merk']; ?></td>
                            <td><?php echo $isi['no_plat']; ?></td>
                            <td><?php echo $isi['harga']; ?></td>
                            <td><?php echo $isi['status']; ?></td>
                            <td><?php echo $isi['tahun']; ?></td>
                            <td><?php echo $isi['spesifikasi']; ?></td>
                            <td><?php echo $isi['deskripsi']; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="edit.php?id=<?php echo $isi['id_mobil']; ?>">Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="proses.php?aksi=hapus&id=<?= $isi['id_mobil']; ?>&gambar=<?= $isi['gambar']; ?>">Hapus</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#mobilTable').DataTable({
            "lengthMenu": [5, 10, 25, 50], // Jumlah baris per halaman
            "language": {
                "search": "Cari:", // Mengubah label pencarian
                "lengthMenu": "Tampilkan _MENU_ data per halaman"
            },
            "columnDefs": [{
                    "orderable": false,
                    "targets": 7
                }, // Matikan pengurutan untuk kolom 'Aksi'
            ]
        });
    });
</script>

<?php include '../footer.php'; ?>