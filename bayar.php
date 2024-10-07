<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
if (empty($_SESSION['USER'])) {
    echo '<script>alert("Harap login !");window.location="index.php"</script>';
}
$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

$id = $hasil['id_mobil'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();

$unik  = random_int(100, 999);
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="container my-5">
    <h1 class="text-center mb-5">
        <span class="display-4 fw-bold text-primary">BOOKING KONFIRMASI</span>
        <br>
        <span class="h3 fw-light text-secondary fst-italic">Your Luxury Journey Awaits</span>
    </h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-lg mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Payment Information</h5>
                    <hr>
                    <p class="card-text">Please transfer to:</p>
                    <p class="card-text fw-bold"><?= $info_web->no_rek; ?></p>
                </div>
            </div>

            <div class="card shadow-lg">
                <img src="images/<?php echo $isi['gambar']; ?>" class="card-img-top" alt="<?php echo $isi['merk']; ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body bg-light">
                    <h5 class="card-title text-center"><?php echo $isi['merk']; ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Status
                        <?php if ($isi['status'] == 'Tersedia') { ?>
                            <span class="badge bg-success rounded-pill">Available</span>
                        <?php } else { ?>
                            <span class="badge bg-danger rounded-pill">Not Available</span>
                        <?php } ?>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Year
                        <span class="badge bg-primary rounded-pill"><?= $isi['tahun'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Capacity
                        <span class="badge bg-info rounded-pill"><?= $isi['spesifikasi'] ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Price per Day
                        <span class="badge bg-warning text-dark rounded-pill">Rp. <?php echo number_format($isi['harga']); ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Booking Details</h4>
                    <table class="table table-striped">
                        <tr>
                            <th>Booking Code</th>
                            <td><?php echo $hasil['kode_booking']; ?></td>
                        </tr>
                        <tr>
                            <th>KTP</th>
                            <td><?php echo $hasil['ktp']; ?></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td><?php echo $hasil['nama']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo $hasil['no_tlp']; ?></td>
                        </tr>
                        <tr>
                            <th>Rental Date</th>
                            <td><?php echo $hasil['tanggal']; ?></td>
                        </tr>
                        <tr>
                            <th>Duration</th>
                            <td><?php echo $hasil['lama_sewa']; ?> days</td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>Rp. <?php echo number_format($hasil['total_harga']); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($hasil['konfirmasi_pembayaran'] == 'Belum Bayar') { ?>
                                    <span class="badge bg-warning text-dark">Pending Payment</span>
                                <?php } else { ?>
                                    <span class="badge bg-success">Paid</span>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>

                    <?php if ($hasil['konfirmasi_pembayaran'] == 'Belum Bayar') { ?>
                        <div class="d-grid gap-2 mt-4">
                            <a href="konfirmasi.php?id=<?php echo $kode_booking; ?>" class="btn btn-primary btn-lg">Confirm Payment</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
</style>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<?php include 'footer.php'; ?>