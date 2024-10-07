<?php
require '../../koneksi/koneksi.php';
$title_web = 'User';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
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
<div class="page-content">
    <section class="row">
        <div class="container">
            <div class="card">
                <div class="card-header text-white bg-primary">
                    <h5 class="card-title pt-2">
                        Daftar User / Pelanggan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>No Telpon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sql = "SELECT * FROM login WHERE level = 'Pengguna' ORDER BY id_login DESC";
                                $row = $koneksi->prepare($sql);
                                $row->execute();
                                $hasil = $row->fetchAll(PDO::FETCH_OBJ);
                                foreach ($hasil as $r) {
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $r->nama_pengguna; ?></td>
                                        <td><?= $r->username; ?></td>
                                        <td><?= $r->email; ?></td>
                                        <td><?= $r->notlp; ?></td>
                                        <td>
                                            <a href="<?php echo $url; ?>admin/booking/booking.php?id=<?= $r->id_login; ?>"
                                                class="btn btn-primary btn-sm">Detail Transaksi</a>
                                        </td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include '../footer.php'; ?>