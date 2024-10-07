<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
$title_web = "LUXURY RENT A CAR";
?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

<div class="container mt-5">
    <h1 id="tampil" class="text-center mb-5">
        <span class="display-4 fw-bold text-primary">LUXURY RENT A CAR</span>
        <br>
        <span class="h3 fw-light text-secondary fst-italic">Our Exclusive Fleet</span>
    </h1>
    <div class="row justify-content-center">
        <?php
        $sql = "SELECT * FROM mobil ORDER BY id_mobil ASC";
        $row = $koneksi->prepare($sql);
        $row->execute();
        $hasil = $row->fetchAll();

        foreach ($hasil as $isi) {
        ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm hover-card">
                    <img src="images/<?= $isi['gambar'] ?>" class="card-img-top" alt="<?= $isi['merk'] ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title font-weight-bold"><?= $isi['merk'] ?></h5>
                        <p class="card-text text-danger font-weight-bold">Rp <?= number_format($isi['harga'], 0, ',', '.') ?> / Day</p>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li class="mb-2"><i class="fas fa-car mr-2"></i> Status: <?= $isi['status'] ?></li>
                            <li class="mb-2"><i class="fas fa-calendar-alt mr-2"></i> Year: <?= $isi['tahun'] ?></li>
                            <li class="mb-2"><i class="fas fa-users mr-2"></i> Capacity: <?= $isi['spesifikasi'] ?></li>
                        </ul>
                        <div class="mt-auto">
                            <button class="btn btn-outline-secondary btn-block mb-2 toggle-details" data-id="<?= $isi['id_mobil'] ?>">Details</button>
                            <a href="booking.php?id=<?= $isi['id_mobil'] ?>" class="btn btn-primary btn-block">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Detail Mobil (Tersembunyi Awalnya) -->
    <div id="car-details-container" class="row mt-5" style="display: none;">
        <div class="col-md-6">
            <img id="car-image" src="" class="img-fluid" alt="Car Image">
        </div>
        <div class="col-md-6">
            <h3 id="car-merk"></h3>
            <p class="text-danger font-weight-bold">Price: <span id="car-price"></span></p>
            <ul class="list-unstyled">
                <li><strong>Status:</strong> <span id="car-status"></span></li>
                <li><strong>Year:</strong> <span id="car-year"></span></li>
                <li><strong>Capacity:</strong> <span id="car-capacity"></span></li>
                <li><strong>Fuel Type:</strong> <span id="car-fuel"></span></li>
                <li><strong>Mileage:</strong> <span id="car-mileage"></span> KM</li>
            </ul>
            <div class="d-flex justify-content-start gap-2 mt-3">
                <a href="#" id="book-now-link" class="btn btn-primary">Book Now</a>
                <button class="btn btn-secondary" id="hide-details">Hide Details</button>
            </div>
            <br>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .card-title {
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 1.1rem;
    }

    .car-details {
        margin-top: 10px;
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Details button click
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', function() {
                const carId = this.getAttribute('data-id');
                const card = this.closest('.card');
                const imageUrl = card.querySelector('img').getAttribute('src');
                const merk = card.querySelector('.card-title').textContent;
                const price = card.querySelector('.card-text').textContent;
                const status = card.querySelector('ul li:nth-child(1)').textContent.split(': ')[1];
                const year = card.querySelector('ul li:nth-child(2)').textContent.split(': ')[1];
                const capacity = card.querySelector('ul li:nth-child(3)').textContent.split(': ')[1];
                const fuel = 'Gasoline'; // Placeholder, replace with actual data
                const mileage = '50,000'; // Placeholder, replace with actual data

                // Update detail section
                document.getElementById('car-image').setAttribute('src', imageUrl);
                document.getElementById('car-merk').textContent = merk;
                document.getElementById('car-price').textContent = price;
                document.getElementById('car-status').textContent = status;
                document.getElementById('car-year').textContent = year;
                document.getElementById('car-capacity').textContent = capacity;
                document.getElementById('car-fuel').textContent = fuel;
                document.getElementById('car-mileage').textContent = mileage;

                // Show the details container
                document.getElementById('car-details-container').style.display = 'flex';
                document.getElementById('tampil').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Hide the list of cars
                document.querySelector('.row').style.display = 'none';

                // Update booking link
                document.getElementById('book-now-link').setAttribute('href', 'booking.php?id=' + carId);
            });
        });

        // Hide details section and show the car list again on button click
        document.getElementById('hide-details').addEventListener('click', function() {
            document.getElementById('car-details-container').style.display = 'none';
            document.querySelector('.row').style.display = 'flex';
        });
    });
</script>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>