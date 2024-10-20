<?php
include 'koneksi.php';
if ($_GET['proses']=='insert'){
    if(isset($_POST['submit'])){
        $tanggal = $_POST['thn'].'-'.$_POST['bln'].'-'.$_POST['tgl']; // Mengubah format tanggal menjadi YYYY-MM-DD
        $hobi = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : ''; // Menggabungkan array hobi menjadi string atau kosong jika tidak ada
        $sql = mysqli_query($db, "INSERT INTO mahasiswa (nim, nama, tgl_lahir, jenis_kelamin, hobi, email, no_telp, alamat) 
                          VALUES ('$_POST[nim]', '$_POST[nama]', '$tanggal', '$_POST[jenis_kelamin]', '$hobi', '$_POST[email]', '$_POST[no_telp]', '$_POST[alamat]')");
        if($sql){
            echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href='index.php';</script>";
        }else{
            // Tambahkan pesan error dari MySQL
            echo "<script>alert('Data Gagal Ditambahkan: " . mysqli_error($db) . "'); window.location.href='index.php?p=mhs';</script>";
        }
    }
}

if ($_GET['proses']=='delete'){
    $hapus=mysqli_query($db,"DELETE FROM mahasiswa WHERE nim='$_GET[nim]'");
    if($hapus){
       header("Location: index.php?p=mhs");
    }else{
        echo "<script>alert('Data Gagal Dihapus'); window.location.href='list_mhs.php';</script>";
    }
}

if ($_GET['proses'] == 'edit') {
    if (isset($_POST['submit'])) {
        $tanggal = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $hobi = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : '';
        $sql = "UPDATE mahasiswa SET 
            nim = '{$_POST['nim']}', 
            nama = '{$_POST['nama']}', 
            tgl_lahir = '$tanggal', 
            jenis_kelamin = '{$_POST['jenis_kelamin']}', 
            hobi = '$hobi', 
            email = '{$_POST['email']}', 
            no_telp = '{$_POST['no_telp']}', 
            alamat = '{$_POST['alamat']}'
            WHERE nim = '{$_POST['nim']}'";

        if (mysqli_query($db, $sql)) {
            echo "<script>window.location.href='index.php?p=mhs&aksi=list'</script>";
        } else {
            echo "<script>alert('Data Gagal Diperbarui'); window.location.href='form_edit.php?nim=$nim';</script>";
        }
    }
}



