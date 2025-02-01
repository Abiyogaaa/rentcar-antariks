<?php

require '../../koneksi/koneksi.php';
$title_web = 'Dashboard';
include '../header.php';

// Query untuk menghitung jumlah akun (kecuali admin), total mobil, mobil tersedia, dan daftar booking terkonfirmasi
$queries = [
    "SELECT COUNT(*) AS total FROM login WHERE level != 'admin'",
    "SELECT COUNT(*) AS total FROM mobil",
    "SELECT COUNT(*) AS total FROM mobil WHERE status = 'tersedia'",
    "SELECT COUNT(*) AS total FROM booking WHERE konfirmasi_pembayaran = 'Pembayaran di terima'"
];

$results = [];
foreach ($queries as $query) {
    $stmt = $koneksi->prepare($query);
    $stmt->execute();
    $results[] = $stmt->fetch(PDO::FETCH_OBJ)->total;
}

// Query untuk jumlah booking berdasarkan tanggal (tgl_input)
$query_chart = "SELECT tgl_input, COUNT(*) AS total FROM booking GROUP BY tgl_input ORDER BY tgl_input";
$stmt_chart = $koneksi->prepare($query_chart);
$stmt_chart->execute();
$bookings = $stmt_chart->fetchAll(PDO::FETCH_ASSOC);

// Pisahkan data untuk Chart
$labels = [];
$values = [];

foreach ($bookings as $row) {
    $labels[] = $row['tgl_input'];  // Tanggal booking
    $values[] = (int)$row['total']; // Jumlah booking
}

// Konversi ke JSON untuk JavaScript
$labels_json = json_encode($labels);
$values_json = json_encode($values);

// Query untuk daftar booking terbaru (notifikasi pemesan baru)
$query_booking = "SELECT kode_booking, nama FROM booking ORDER BY tgl_input DESC LIMIT 5";
$stmt_booking = $koneksi->prepare($query_booking);
$stmt_booking->execute();
$new_bookings = $stmt_booking->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


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
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">User</h6>
                                    <h6 class="font-extrabold mb-0"> <?= $results[0] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Total Mobil</h6>
                                    <h6 class="font-extrabold mb-0"><?= $results[1] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="fas fa-car"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Mobil Tersedia</h6>
                                    <h6 class="font-extrabold mb-0"><?= $results[2] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Sedang di proses</h6>
                                    <h6 class="font-extrabold mb-0"><?= $results[3] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Chart -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visitx"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tambahkan CDN FontAwesome dan ApexCharts -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

            <script>
                var options = {
                    series: [{
                        name: 'Total Booking',
                        data: <?= $values_json ?> // Data jumlah booking
                    }],
                    chart: {
                        type: 'line',
                        height: 350
                    },
                    xaxis: {
                        categories: <?= $labels_json ?>, // Label tanggal booking
                        title: {
                            text: 'Tanggal'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Booking'
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#chart-profile-visitx"), options);
                chart.render();
            </script>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="<?php echo $url; ?>images/rentcar.svg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold"><?php echo $_SESSION['USER']['nama_pengguna']; ?></h5>
                            <!-- <h6 class="text-muted mb-0">is <?php echo $_SESSION['USER']['username']; ?></h6> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Notifikasi Pemesan Baru -->
            <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                    <?php if (count($new_bookings) > 0): ?>
                        <?php foreach ($new_bookings as $booking): ?>
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <!-- <img src="../../assets/compiled/jpg/default.jpg" alt="User"> -->
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1"><?= htmlspecialchars($booking['nama']) ?></h5>
                                    <h6 class="text-muted mb-0">Kode Booking: <?= htmlspecialchars($booking['kode_booking']) ?></h6>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center text-muted py-3">
                            <p>Tidak ada pemesan baru.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Tambahkan CDN FontAwesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

            <!-- Script untuk Chart -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                var ctx = document.getElementById('chart-profile-visit').getContext('2d');
                var chartProfileVisit = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?= $labels_json ?>, // Labels tanggal
                        datasets: [{
                            label: 'Jumlah Booking',
                            data: <?= $values_json ?>, // Data jumlah booking
                            borderColor: 'rgba(75, 192, 192, 1)',
                            fill: false,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Jumlah'
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </section>
</div>
<?php include '../footer.php'; ?>