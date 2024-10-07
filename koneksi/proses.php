<?php
session_start();
require 'koneksi.php';
if ($_GET['id'] == 'login') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $row = $koneksi->prepare("SELECT * FROM login WHERE username = ? AND password = md5(?)");

    $row->execute(array($user, $pass));

    $hitung = $row->rowCount();

    if ($hitung > 0) {

        session_start();
        $hasil = $row->fetch();

        $_SESSION['USER'] = $hasil;

        if ($_SESSION['USER']['level'] == 'admin') {
            echo '<script>alert("Login Sukses");window.location="../admin/informasi/dashboard.php";</script>';
        } else {
            echo '<script>alert("Login Sukses");window.location="../index.php";</script>';
        }
    } else {
        echo '<script>alert("Login Gagal");window.location="../login.php";</script>';
    }
}

if ($_GET['id'] == 'daftar') {
    $data[] = $_POST['nama'];
    $data[] = $_POST['user'];
    $data[] = md5($_POST['pass']);
    $data[] = ($_POST['email']);
    $data[] = ($_POST['notlp']);
    $data[] = 'pengguna';

    $row = $koneksi->prepare("SELECT * FROM login WHERE username = ?");

    $row->execute(array($_POST['user']));

    $hitung = $row->rowCount();

    if ($hitung > 0) {
        echo '<script>alert("Daftar Gagal, Username Sudah digunakan ");window.location="../login.php";</script>';
    } else {

        $sql = "INSERT INTO `login`(`nama_pengguna`, `username`, `password`, `email`, `notlp` , `level`)
                VALUES (?,?,?,?,?,?)";
        $row = $koneksi->prepare($sql);
        $row->execute($data);

        echo '<script>alert("Daftar Sukses, Silahkan Login");window.location="../login.php";</script>';
    }
}

if ($_GET['id'] == 'booking') {
    $total = $_POST['total_harga'] * $_POST['lama_sewa'];
    $unik  = random_int(100, 999);
    $total_harga = $total + $unik;

    $data[] = time();
    $data[] = $_POST['id_login'];
    $data[] = $_POST['id_mobil'];
    $data[] = $_POST['ktp'];
    $data[] = $_POST['nama'];
    $data[] = $_POST['alamat'];
    $data[] = $_POST['no_tlp'];
    $data[] = $_POST['tanggal'];
    $data[] = $_POST['lama_sewa'];
    $data[] = $total_harga;
    $data[] = "Belum Bayar";
    $data[] = date('Y-m-d');

    $sql = "INSERT INTO booking (kode_booking, 
    id_login, 
    id_mobil, 
    ktp, 
    nama, 
    alamat, 
    no_tlp, 
    tanggal, lama_sewa, total_harga, konfirmasi_pembayaran, tgl_input) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script>alert("Anda Sukses Booking silahkan Melakukan Pembayaran");
    window.location="../bayar.php?id=' . time() . '";</script>';
}

if (isset($_GET['id']) && $_GET['id'] == 'konfirmasi') {

    // Pastikan semua data di POST diterima
    if (!empty($_POST['id_booking']) && !empty($_POST['no_rekening']) && !empty($_POST['nama']) && !empty($_POST['nominal']) && !empty($_POST['tgl'])) {

        try {
            // Simpan data pembayaran
            $data = [];
            $data[] = $_POST['id_booking'];
            $data[] = $_POST['no_rekening'];
            $data[] = $_POST['nama'];
            $data[] = $_POST['nominal'];
            $data[] = $_POST['tgl'];

            $sql = "INSERT INTO pembayaran (id_booking, no_rekening, nama_rekening, nominal, tanggal) VALUES (?,?,?,?,?)";
            $stmt = $koneksi->prepare($sql);
            $stmt->execute($data);

            // Update status pembayaran di tabel booking
            $data2 = [];
            $data2[] = 'Sedang di proses';
            $data2[] = $_POST['id_booking'];

            $sql2 = "UPDATE booking SET konfirmasi_pembayaran = ? WHERE id_booking = ?";
            $stmt2 = $koneksi->prepare($sql2);
            $stmt2->execute($data2);

            echo '<script>alert("Kirim Sukses , Pembayaran anda sedang diproses");history.go(-2);</script>';
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo '<script>alert("Harap lengkapi semua data!");history.go(-1);</script>';
    }
}
