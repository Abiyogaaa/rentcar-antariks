<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
if (empty($_SESSION['USER'])) {
    echo '<script>alert("Harap Login");window.location="index.php"</script>';
}
$kode_booking = $_GET['id'];
$hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

$id = $hasil['id_mobil'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="container my-5">
    <h1 class="text-center mb-5">
        <span class="display-4 fw-bold text-primary">Payment Confirmation</span>
        <br>
        <span class="h3 fw-light text-secondary fst-italic">Secure Your Luxury Experience</span>
    </h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h3 class="card-title mb-4">Payment Details</h3>
                    <hr>
                    <p class="card-text">Please transfer to:</p>
                    <p class="card-text fw-bold">SEABANK <?= $info_web->no_rek; ?></p>
                    <p class="card-text">A/N AULIA.RENTCAR</p>
                    <div class="mt-4">
                        <p class="mb-2">Total Amount Due:</p>
                        <h4 class="text-primary">Rp. <?php echo number_format($hasil['total_harga']); ?></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Confirm Your Payment</h4>
                    <form method="post" action="koneksi/proses.php?id=konfirmasi">
                        <div class="mb-3">
                            <label for="kode_booking" class="form-label">Booking Code</label>
                            <input type="text" class="form-control" id="kode_booking" value="<?php echo $hasil['kode_booking']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_rekening" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Account Holder Name</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="nominal" class="form-label">Transfer Amount</label>
                            <input type="text" class="form-control" id="nominal" name="nominal" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl" class="form-label">Transfer Date</label>
                            <input type="date" class="form-control" id="tgl" name="tgl" required>
                        </div>
                        <input type="hidden" name="id_booking" value="<?php echo $hasil['id_booking']; ?>">
                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Confirm Payment</button>
                        </div>
                    </form>
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