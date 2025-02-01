<?php
require '../../koneksi/koneksi.php';
$title_web = 'Peminjaman';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 text-white">
                        <i class="fas fa-search me-2"></i>Cari Booking
                    </h4>
                </div>
                <div class="card-body mt-4">
                    <form method="get" action="peminjaman.php">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg"
                                name="id"
                                placeholder="Masukkan Kode Booking"
                                value="<?= !empty($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (!empty($_GET['id'])) {
            $kode_booking = $_GET['id'];
            $hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();
            $id_booking = $hasil['id_booking'];

            if (!isset($id_booking)) {
                echo '<div class="col-12"><div class="alert alert-danger">Tidak Ada Data!</div></div>';
                exit;
            }

            $hsl = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->fetch();
            $id = $hasil['id_mobil'];
            $isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
        ?>
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0 text-white">Detail Pembayaran</h5>
                    </div>
                    <div class="card-body mt-4">
                        <table class="table table-borderless">
                            <tr>
                                <th class="ps-0">No Rekening</th>
                                <td><?= htmlspecialchars($hsl['no_rekening']); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0">Atas Nama</th>
                                <td><?= htmlspecialchars($hsl['nama_rekening']); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0">Nominal</th>
                                <td>Rp. <?= number_format($hsl['nominal']); ?></td>
                            </tr>
                            <tr>
                                <th class="ps-0">Tgl Transfer</th>
                                <td><?= htmlspecialchars($hsl['tanggal']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header text-center bg-light">
                        <img src="../../images/<?= htmlspecialchars($isi['gambar']); ?>"
                            class="img-fluid rounded"
                            style="max-height: 200px; object-fit: cover;">
                        <h5 class="mt-3 mb-0"><?= htmlspecialchars($isi['merk']); ?></h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item <?= $isi['status'] == 'Tersedia' ? 'bg-success' : 'bg-danger'; ?> text-white">
                            <i class="fas <?= $isi['status'] == 'Tersedia' ? 'fa-check' : 'fa-close'; ?> me-2"></i>
                            <?= $isi['status'] == 'Tersedia' ? 'Tersedia' : 'Tidak Tersedia'; ?>
                        </div>
                        <div class="list-group-item bg-light">
                            <i class="fas fa-info-circle me-2"></i>
                            <?= htmlspecialchars($isi['spesifikasi']); ?>
                        </div>
                        <div class="list-group-item bg-secondary text-white">
                            <i class="fas fa-money-bill-wave me-2"></i>
                            Rp. <?= number_format($isi['harga']); ?> / hari
                        </div>
                        <div class="list-group-item">
                            <i class="fas fa-car me-2"></i>
                            <?= htmlspecialchars($isi['no_plat']); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">Detail Booking & Status Mobil</h5>
                    </div>
                    <div class="card-body mt-4">
                        <form method="post" action="proses.php?id=konfirmasi">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Booking</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($hasil['kode_booking']); ?>"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">KTP</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($hasil['ktp']); ?>"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($hasil['nama']); ?>"
                                        readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($hasil['no_tlp']); ?>"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Sewa</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($hasil['tanggal']); ?>"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Lama Sewa</label>
                                    <input type="text" class="form-control"
                                        value="<?= htmlspecialchars($hasil['lama_sewa']); ?> hari"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Total Harga</label>
                                    <input type="text" class="form-control"
                                        value="Rp. <?= number_format($hasil['total_harga']); ?>"
                                        readonly>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Status Mobil</label>
                                    <select class="form-select" name="status">
                                        <option value="Tersedia" <?= $isi['status'] == 'Tersedia' ? 'selected' : ''; ?>>
                                            Tersedia (Kembali)
                                        </option>
                                        <option value="Tidak Tersedia" <?= $isi['status'] == 'Tidak Tersedia' ? 'selected' : ''; ?>>
                                            Tidak Tersedia (Pinjam)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id_mobil" value="<?= $isi['id_mobil']; ?>">
                            <div class="text-end">
                                <!-- Tombol Ubah Status -->
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check2-circle me-2"></i>Ubah Status
                                </button>

                                <!-- Tombol Print dengan Ikon -->
                                <button type="button" class="btn btn-success" onclick="window.location.href='cetakstruk.php?id=<?= $hasil['kode_booking']; ?>'">
                                    <i class="bi bi-printer"></i> Cetak Struk
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include '../footer.php'; ?>