<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
if (empty($_SESSION['USER'])) {
  echo '<script>alert("Harap login !");window.location="index.php"</script>';
}
$id = $_GET['id'];
$isi = $koneksi->query("SELECT * FROM mobil WHERE id_mobil = '$id'")->fetch();
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<div class="container my-5">
  <h1 class="text-center mb-5">
    <span class="display-4 fw-bold text-primary">BOOKING RENTAL</span>
    <br>
    <span class="h3 fw-light text-secondary fst-italic">Our Exclusive Fleet</span>
  </h1>

  <div class="row g-4">
    <div class="col-md-5">
      <div class="card shadow-lg h-100">
        <img src="images/<?php echo $isi['gambar']; ?>" class="card-img-top mt-2" alt="<?php echo $isi['merk']; ?>" style="height: 250px; object-fit: cover;">
        <div class="card-body bg-light">
          <h3 class="card-title text-center mb-4"><?php echo $isi['merk']; ?></h3>
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
    </div>
    <div class="col-md-7">
      <div class="card shadow-lg">
        <div class="card-body">
          <h4 class="card-title text-center mb-4">Booking Details</h4>
          <form method="post" action="koneksi/proses.php?id=booking">
            <div class="row g-3">
              <div class="col-md-6">
                <label for="ktp" class="form-label">KTP</label>
                <input type="text" name="ktp" id="ktp" required class="form-control" placeholder="KTP / NIK Anda">
              </div>
              <div class="col-md-6">
                <label for="nama" class="form-label">Name</label>
                <input type="text" name="nama" id="nama" required class="form-control" placeholder="Nama Anda">
              </div>
              <div class="col-12">
                <label for="alamat" class="form-label">Address</label>
                <input type="text" name="alamat" id="alamat" required class="form-control" placeholder="Alamat">
              </div>
              <div class="col-md-6">
                <label for="no_tlp" class="form-label">Phone</label>
                <input type="text" name="no_tlp" id="no_tlp" required class="form-control" placeholder="Telepon">
              </div>
              <div class="col-md-6">
                <label for="tanggal" class="form-label">Rental Date</label>
                <input type="date" name="tanggal" id="tanggal" required class="form-control">
              </div>
              <div class="col-12">
                <label for="lama_sewa" class="form-label">Rental Duration (days)</label>
                <input type="number" name="lama_sewa" id="lama_sewa" required class="form-control" placeholder="Lama Sewa">
              </div>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['USER']['id_login']; ?>" name="id_login">
            <input type="hidden" value="<?php echo $isi['id_mobil']; ?>" name="id_mobil">
            <input type="hidden" value="<?php echo $isi['harga']; ?>" name="total_harga">
            <div class="d-grid gap-2 mt-4">
              <?php if ($isi['status'] == 'Tersedia') { ?>
                <button type="submit" class="btn btn-primary btn-lg">Book Now</button>
              <?php } else { ?>
                <button type="submit" class="btn btn-danger btn-lg" disabled>Not Available</button>
              <?php } ?>
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