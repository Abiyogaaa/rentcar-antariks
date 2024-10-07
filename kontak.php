<?php
session_start();
require 'koneksi/koneksi.php';
include 'header.php';
?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .contact-section {
        padding: 50px 0;
    }

    .contact-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .contact-header h1 {
        font-size: 2.5rem;
        color: #333;
    }

    .contact-header p {
        font-size: 1.1rem;
        color: #666;
    }

    .contact-icon {
        font-size: 3rem;
        color: #4a69bd;
        margin-bottom: 15px;
    }

    .contact-form {
        background-color: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .contact-form h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .form-control {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #4a69bd;
        border-color: #4a69bd;
    }

    .btn-primary:hover {
        background-color: #3a559b;
        border-color: #3a559b;
    }

    .contact-info {
        background-color: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .contact-info h3 {
        margin-bottom: 20px;
        color: #333;
    }

    .contact-info-item {
        margin-bottom: 15px;
    }

    .contact-info-item i {
        color: #4a69bd;
        margin-right: 10px;
    }
</style>
<div class="contact-section">
    <div class="container">
        <div class="contact-header">
            <h1>Hubungi Kami</h1>
            <p>Kami siap membantu Anda. Silakan hubungi kami melalui form di bawah ini.</p>
            <div class="contact-icon">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form">
                    <h2>Kirim Pesan</h2>
                    <form>
                        <select class="form-control">
                            <option selected disabled>Saya ingin bertanya tentang...</option>
                            <option>Informasi Rental</option>
                            <option>Reservasi</option>
                            <option>Harga</option>
                            <option>Lainnya</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Nama Anda">
                        <input type="email" class="form-control" placeholder="Email Anda">
                        <textarea class="form-control" rows="5" placeholder="Pesan Anda"></textarea>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contact-info">
                    <h3>Informasi Kontak</h3>
                    <div class="contact-info-item">
                        <i class="fas fa-building"></i> <?= $info_web->nama_rental; ?>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-phone"></i> <?= $info_web->telp; ?>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i> <?= $info_web->alamat; ?>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i> <?= $info_web->email; ?>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-credit-card"></i> No Rekening: <?= $info_web->no_rek; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>