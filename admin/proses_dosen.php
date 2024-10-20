<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nik = $_POST['nik'];
        $nama_dosen = $_POST['nama_dosen'];
        $email = $_POST['email'];
        $prodi_id = $_POST['prodi_id'];
        $notelp = $_POST['notelp'];
        $alamat = $_POST['alamat'];

        $sql = "INSERT INTO dosen (nik, nama_dosen, email, prodi_id, notelp, alamat) VALUES ('$nik', '$nama_dosen', '$email', '$prodi_id', '$notelp', '$alamat')";
        $result = mysqli_query($db, $sql);

        if ($result) {
            echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href='index.php?p=dosen';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan'); window.location.href='index.php?p=dosen&aksi=input';</script>";
        }
    }
}

if ($_GET['proses'] == 'delete') {
    $hapus = mysqli_query($db, "DELETE FROM dosen WHERE id='$_GET[id]'");
    if ($hapus) {
        header("Location: index.php?p=dosen");
    } else {
        echo "<script>alert('Data Gagal Dihapus'); window.location.href='index.php?p=dosen';</script>";
    }
}

if ($_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nik = $_POST['nik'];
        $nama_dosen = $_POST['nama_dosen'];
        $email = $_POST['email'];
        $prodi_id = $_POST['prodi_id'];
        $notelp = $_POST['notelp'];
        $alamat = $_POST['alamat'];

        $sql = "UPDATE dosen SET 
            nik = '$nik', 
            nama_dosen = '$nama_dosen', 
            email = '$email', 
            prodi_id = '$prodi_id', 
            notelp = '$notelp', 
            alamat = '$alamat' 
            WHERE id = '$id'";

        if (mysqli_query($db, $sql)) {
            echo "<script>window.location.href='index.php?p=dosen'</script>";
        } else {
            echo "<script>alert('Data Gagal Diperbarui'); window.location.href='index.php?p=dosen&aksi=edit&id=$id';</script>";
        }
    }
}
?>
