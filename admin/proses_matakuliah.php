<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $kode_matakuliah = $_POST['kode_matakuliah'];
        $nama_matakuliah = $_POST['nama_matakuliah'];
        $semester = $_POST['semester'];
        $jenis_matakuliah = $_POST['jenis_matakuliah'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];
        $keterangan = $_POST['keterangan'];

        $sql = mysqli_query($db, "INSERT INTO matakuliah (kode_matakuliah, nama_matakuliah, semester, jenis_matakuliah, sks, jam, keterangan) 
                          VALUES ('$kode_matakuliah', '$nama_matakuliah', '$semester', '$jenis_matakuliah', '$sks', '$jam', '$keterangan')");
        
        if ($sql) {
            echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href='index.php?p=matakuliah';</script>";
        } else {
            echo "<script>alert('Data Gagal Ditambahkan: " . mysqli_error($db) . "'); window.location.href='index.php?p=matakuliah&aksi=input';</script>";
        }
    }
}

if ($_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $kode_matakuliah = $_POST['kode_matakuliah'];
        $nama_matakuliah = $_POST['nama_matakuliah'];
        $semester = $_POST['semester'];
        $jenis_matakuliah = $_POST['jenis_matakuliah'];
        $sks = $_POST['sks'];
        $jam = $_POST['jam'];
        $keterangan = $_POST['keterangan'];

        $sql = "UPDATE matakuliah SET 
            kode_matakuliah = '$kode_matakuliah', 
            nama_matakuliah = '$nama_matakuliah', 
            semester = '$semester', 
            jenis_matakuliah = '$jenis_matakuliah', 
            sks = '$sks', 
            jam = '$jam', 
            keterangan = '$keterangan'
            WHERE id = '$id'";

        if (mysqli_query($db, $sql)) {
            echo "<script>alert('Data Berhasil Diperbarui'); window.location.href='index.php?p=matakuliah';</script>";
        } else {
            echo "<script>alert('Data Gagal Diperbarui: " . mysqli_error($db) . "'); window.location.href='index.php?p=matakuliah&aksi=edit&id=$id';</script>";
        }
    }
}

if ($_GET['proses'] == 'delete') {
    $id = $_GET['id'];
    $hapus = mysqli_query($db, "DELETE FROM matakuliah WHERE id='$id'");
    
    if ($hapus) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location.href='index.php?p=matakuliah';</script>";
    } else {
        echo "<script>alert('Data Gagal Dihapus: " . mysqli_error($db) . "'); window.location.href='index.php?p=matakuliah';</script>";
    }
}
?>
