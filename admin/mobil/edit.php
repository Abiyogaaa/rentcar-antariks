<?php

require '../../koneksi/koneksi.php';
$title_web = 'Edit Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
$id = $_GET['id'];

$sql = "SELECT * FROM mobil WHERE id_mobil =  ?";
$row = $koneksi->prepare($sql);
$row->execute(array($id));

$hasil = $row->fetch();
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
                    Ubah Informasi Mobil
                </h4>
                <div>
                    <a class="btn btn-outline-light d-flex align-items-center" href="mobil.php" role="button">
                        <i data-feather="arrow-left" class="me-1"></i> Kembali
                    </a>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container">
                <form method="post" action="proses.php?aksi=edit&id=<?= $id; ?>" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-sm-6">
                            <br>
                            <div class="form-group row">
                                <label class="col-sm-3">No Plat</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['no_plat']; ?>" name="no_plat" placeholder="Isi No Plat">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Merk Mobil</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['merk']; ?>" name="merk" placeholder="Isi Merk">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Harga</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['harga']; ?>" name="harga" placeholder="Isi Harga">
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Deskripsi</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['deskripsi']; ?>" name="deskripsi" placeholder="Isi Deskripsi">
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <br>
                            <div class="form-group row mx-1">
                                <label class="col-sm-4">Tahun</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['tahun']; ?>" name="tahun" placeholder="Isi Deskripsi">
                            </div>
                            <div class="form-group row mx-1">
                                <label class="col-sm-4">Kapasitas</label>
                                <input type="text" class="form-control col-sm-9" value="<?= $hasil['spesifikasi']; ?>" name="spesifikasi" placeholder="Isi Deskripsi">
                            </div>
                            <div class="form-group row mx-1">
                                <label class="col-sm-4">Status</label>
                                <select class="form-control col-sm-9" name="status">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option <?php if ($hasil['status'] == 'Tersedia') {
                                                echo 'selected';
                                            } ?>>Tersedia</option>
                                    <option <?php if ($hasil['status'] == 'Tidak Tersedia') {
                                                echo 'selected';
                                            } ?>>Tidak Tersedia</option>
                                </select>
                            </div>

                            <div class="form-group row mx-1">
                                <label class="col-sm-4">Gambar</label>
                                <input type="file" accept="image/*" class="form-control col-sm-9" name="gambar" placeholder="Isi Gambar">

                            </div>
                            <div class="form-group row mx-1">
                                <label class="col-sm-5">Tampilan Sebelumnya:</label>
                                <img src="../../images/<?php echo $hasil['gambar']; ?>" class="img-fluid" style="width:200px;">
                            </div>
                            <input type="hidden" value="<?= $hasil['gambar']; ?>" name="gambar_cek">
                        </div>
                    </div>
                    <hr>
                    <div class="float-right">
                        <button class="btn btn-outline-primary" role="button" type="submit">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>