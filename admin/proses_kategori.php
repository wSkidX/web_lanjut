<?php
include 'koneksi.php';

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];
        
        $sql = mysqli_query($db, "INSERT INTO kategori (nama_kategori, keterangan) VALUES ('$nama_kategori', '$keterangan')");
        
        if ($sql) {
            echo "<script>alert('Kategori Berhasil Ditambahkan'); window.location.href='index.php?p=kategori';</script>";
        } else {
            echo "<script>alert('Kategori Gagal Ditambahkan'); window.location.href='index.php?p=kategori';</script>";
        }
    }
}

if ($_GET['proses'] == 'delete') {
    $hapus = mysqli_query($db, "DELETE FROM kategori WHERE id='$_GET[id]'");
    
    if ($hapus) {
        header("Location: index.php?p=kategori");
    } else {
        echo "<script>alert('Kategori Gagal Dihapus'); window.location.href='index.php?p=kategori';</script>";
    }
}

if ($_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $nama_kategori = $_POST['nama_kategori'];
        $keterangan = $_POST['keterangan'];
        
        $sql = "UPDATE kategori SET 
            nama_kategori = '$nama_kategori', 
            keterangan = '$keterangan' 
            WHERE id = '$_POST[id]'";
        
        if (mysqli_query($db, $sql)) {
            echo "<script>window.location.href='index.php?p=kategori'</script>";
        } else {
            echo "<script>alert('Kategori Gagal Diperbarui'); window.location.href='index.php?p=kategori&aksi=edit&id=$_POST[id]';</script>";
        }
    }
}