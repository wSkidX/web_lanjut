<?php
session_start();
$target_dir = "uploads/";
$nama_file = rand() . '_' . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $nama_file; // Perbaikan pada nama file
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';

        // Cek apakah file yang diupload adalah gambar
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Cek apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Cek ukuran file
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Hanya izinkan format file tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Jika tidak ada error, proses upload file
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                
                // Query insert berita
                $sql = mysqli_query($db, "INSERT INTO berita (user_id, kategori_id, judul, file_upload, isi_berita) VALUES ('$_SESSION[user_id]', '$_POST[kategori_id]', '$_POST[judul]', '$nama_file', '$_POST[isi_berita]')");

                if ($sql) {
                    echo "<script>window.location='index.php?p=berita'</script>";
                } else {
                    echo "Error: " . mysqli_error($db);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

if ($_GET['proses'] == 'edit') {
    include 'koneksi.php';

    // Update data berita
    $sql = mysqli_query($db, "UPDATE berita SET 
        kategori_id = '$_POST[kategori_id]',
        judul = '$_POST[judul]',
        file_upload = '$_POST[file_upload]', -- file lama jika tidak diubah
        isi_berita = '$_POST[isi_berita]'
        WHERE id = '$_POST[id]'");

    if ($sql) {
        echo "<script>window.location='index.php?p=berita'</script>";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}

if ($_GET['proses'] == 'delete') {
    include 'koneksi.php';
    // Hapus file fisik di folder
    unlink('uploads/' . $_GET['file']);
    
    // Hapus data dari database
    $hapus = mysqli_query($db, "DELETE FROM berita WHERE id = '$_GET[id]'");
    if ($hapus) {
        header('location:index.php?p=berita');
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?