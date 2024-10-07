<?php

require '../../koneksi/koneksi.php';
$title_web = 'Tambah Mobil';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

if ($_GET['aksi'] == 'tambah') {

    $allowedImageType = array("image/gif", "image/JPG", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", 'image/webp');
    $filepath = $_FILES['gambar']['tmp_name'];
    $fileSize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);
    $allowedTypes = [
        'image/png'   => 'png',
        'image/jpeg'  => 'jpg',
        'image/gif'   => 'gif',
        'image/jpg'   => 'jpeg',
        'image/webp'  => 'webp'
    ];
    if (!in_array($filetype, array_keys($allowedTypes))) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Invalid File Type",
                    text: "You can only upload JPG, PNG, and GIF files!"
                }).then(() => {
                    window.location="tambah.php";
                });
              </script>';
        exit();
    } else if ($_FILES['gambar']["error"] > 0) {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "File Error",
                    text: "There was an error with the file!"
                }).then(() => {
                    history.go(-1);
                });
              </script>';
        exit();
    } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
        echo '<script>
                Swal.fire({
                    icon: "warning",
                    title: "File Too Large",
                    text: "Image size cannot exceed 4MB!"
                }).then(() => {
                    window.location="tambah.php";
                });
              </script>';
        exit();
    } else {
        $dir = '../../images/';
        $tmp_name = $_FILES['gambar']['tmp_name'];
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $target_path = $dir . basename($newfilename);
        if (move_uploaded_file($tmp_name, $target_path)) {
            $data[] = $_POST['no_plat'];
            $data[] = $_POST['merk'];
            $data[] = $_POST['harga'];
            $data[] = $_POST['deskripsi'];
            $data[] = $_POST['status'];
            $data[] = $newfilename;
            $data[] = $_POST['tahun'];
            $data[] = $_POST['spesifikasi'];

            $sql = "INSERT INTO `mobil`(`no_plat`, `merk`, `harga`, `deskripsi`, `status`, `gambar`, `tahun`, `spesifikasi`) 
                VALUES (?,?,?,?,?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);
            echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Mobil berhasil ditambahkan!"
                    }).then(() => {
                        window.location="mobil.php";
                    });
                  </script>';
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Upload Failed",
                        text: "Please upload an image!"
                    }).then(() => {
                        window.location="tambah.php";
                    });
                  </script>';
        }
    }
}

if ($_GET['aksi'] == 'edit') {
    $id = $_GET['id'];
    $gambar = $_POST['gambar_cek'];

    $data = [
        $_POST['no_plat'],
        $_POST['merk'],
        $_POST['harga'],
        $_POST['deskripsi'],
        $_POST['status'],
        $_POST['tahun'],
        $_POST['spesifikasi']
    ];

    // Validasi file gambar
    if ($_FILES['gambar']['size'] > 0) {
        $allowedTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($_FILES['gambar']['tmp_name']);
        $fileSize = $_FILES['gambar']['size'];

        if (!in_array($fileType, $allowedTypes)) {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Invalid File Type",
                        text: "Only JPG, PNG, GIF, and WebP files are allowed!"
                    }).then(() => {
                        history.go(-1);
                    });
                  </script>';
            exit();
        } elseif ($fileSize > 4096 * 1024) { // Maksimal 4MB
            echo '<script>
                    Swal.fire({
                        icon: "warning",
                        title: "File Too Large",
                        text: "Image size cannot exceed 4MB!"
                    }).then(() => {
                        history.go(-1);
                    });
                  </script>';
            exit();
        } else {
            // Upload gambar
            $dir = '../../images/';
            $newFilename = round(microtime(true)) . '.' . pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $targetPath = $dir . basename($newFilename);

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
                if (file_exists($dir . $gambar)) {
                    unlink($dir . $gambar); // Hapus gambar lama
                }
                $data[] = $newFilename;
            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "File Upload Error",
                            text: "There was an error uploading the file!"
                        }).then(() => {
                            history.go(-1);
                        });
                      </script>';
                exit();
            }
        }
    } else {
        $data[] = $gambar; // Tetap gunakan gambar lama jika tidak ada file yang diupload
    }

    $data[] = $id;

    // Proses update data
    $sql = "UPDATE mobil SET no_plat = ?, merk = ?, harga = ?, deskripsi = ?, status = ?, tahun = ?, spesifikasi = ?, gambar = ? WHERE id_mobil = ?";
    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Mobil berhasil diupdate!"
            }).then(() => {
                window.location="mobil.php";
            });
          </script>';
}


if (!empty($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    unlink('../../assets/image/' . $gambar);

    $sql = "DELETE FROM mobil WHERE id_mobil = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Mobil berhasil dihapus!"
            }).then(() => {
                window.location="mobil.php";
            });
          </script>';
}
