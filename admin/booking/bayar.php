<?php
require '../../koneksi/koneksi.php';
$title_web = 'Konfirmasi Booking';
include '../header.php';
session_start();
if (empty($_SESSION['USER'])) {
    echo '<script>alert("login dulu");window.location="../../login.php"</script>';
}
$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

$id_booking = $hasil['id_booking'];
$hsl = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->fetch();
$c = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->rowCount();

$id = $hasil['id_mobil'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>

<div class="container-fluid py-8 px-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">Detail Booking #<?php echo $hasil['kode_booking']; ?></h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Vehicle Details -->
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="position-relative">
                                    <img src="../../images/<?php echo $isi['gambar']; ?>"
                                        class="card-img-top p-3"
                                        alt="<?php echo $isi['merk']; ?>">
                                    <div class="position-absolute top-0 end-0 p-2">
                                        <?php if ($isi['status'] == 'Tersedia') { ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger">Tidak Tersedia</span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title text-center mb-3"><?php echo $isi['merk']; ?></h5>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-gear-fill me-2"></i>Spesifikasi</span>
                                            <span class="text-muted"><?php echo $isi['spesifikasi']; ?></span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-cash me-2"></i>Harga/Hari</span>
                                            <span class="text-primary">Rp. <?php echo number_format($isi['harga']); ?></span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><i class="bi bi-car-front-fill me-2"></i>No. Plat</span>
                                            <span class="text-muted"><?php echo $isi['no_plat']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Booking Details -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm mb-4 mt-4">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Informasi Penyewa</h5>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="proses.php?id=konfirmasi" class="needs-validation" novalidate>
                                        <div class="row g-3 mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" value="<?php echo $hasil['nama']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">No. KTP</label>
                                                <input type="text" class="form-control" value="<?php echo $hasil['ktp']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">No. Telepon</label>
                                                <input type="text" class="form-control" value="<?php echo $hasil['no_tlp']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Sewa</label>
                                                <input type="text" class="form-control" value="<?php echo $hasil['tanggal']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Lama Sewa</label>
                                                <input type="text" class="form-control" value="<?php echo $hasil['lama_sewa']; ?> hari" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Total Harga</label>
                                                <input type="text" class="form-control" value="Rp. <?php echo number_format($hasil['total_harga']); ?>" readonly>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Status Pembayaran</label>
                                                <select class="form-select" name="status">
                                                    <option <?php if ($hasil['konfirmasi_pembayaran'] == 'Sedang di proses') echo 'selected'; ?>>
                                                        Sedang di proses
                                                    </option>
                                                    <option <?php if ($hasil['konfirmasi_pembayaran'] == 'Pembayaran di terima') echo 'selected'; ?>>
                                                        Pembayaran di terima
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_booking" value="<?php echo $hasil['id_booking']; ?>">

                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bi bi-check2-circle me-2"></i>Update Status
                                            </button>
                                            <a href="<?php echo $url; ?>admin/peminjaman/peminjaman.php?id=<?php echo $hasil['kode_booking']; ?>"
                                                class="btn btn-success">
                                                <i class="bi bi-arrow-repeat me-2"></i>Update Peminjaman
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <?php if ($c > 0) { ?>
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Detail Pembayaran</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 mt-2">
                                            <div class="col-md-6">
                                                <label class="form-label">No. Rekening</label>
                                                <input type="text" class="form-control" value="<?php echo $hsl['no_rekening']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Atas Nama</label>
                                                <input type="text" class="form-control" value="<?php echo $hsl['nama_rekening']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nominal Transfer</label>
                                                <input type="text" class="form-control" value="Rp. <?php echo number_format($hsl['nominal']); ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Transfer</label>
                                                <input type="text" class="form-control" value="<?php echo $hsl['tanggal']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-warning" role="alert">
                                    <i class="bi bi-exclamation-triangle me-2"></i>
                                    Pembayaran belum dilakukan
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>

<script>
    // Enable Bootstrap form validation
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>