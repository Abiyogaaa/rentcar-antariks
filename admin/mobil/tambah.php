<?php
require '../../koneksi/koneksi.php';
$title_web = 'Tambah Mobil';
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

<div class="container">
    <div class="card">
        <div class="card-header text-white bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Masukkan Informasi Mobil</h4>
                <a class="btn btn-outline-light d-flex align-items-center" href="mobil.php" role="button">
                    <i data-feather="arrow-left" class="me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <form method="post" action="proses.php?aksi=tambah" enctype="multipart/form-data">
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-sm-6 mt-3">
                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">No Plat</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="no_plat" placeholder="Isi No Plat" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Merk Mobil</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="merk" placeholder="Isi Merk" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="harga" placeholder="Isi Harga" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Deskripsi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="deskripsi" placeholder="Isi Deskripsi">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-sm-6 mt-3">
                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Tahun</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="tahun" placeholder="Isi tahun" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Kapasitas</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="spesifikasi" placeholder="Isi spesifikasi">
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status" required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="col-sm-3 col-form-label">Gambar</label>
                            <div class="col-sm-9">
                                <input type="file" accept="image/*" class="form-control" name="gambar" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="float-right mt-3">
                    <button class="btn btn-outline-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>