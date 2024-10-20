<?php
include 'koneksi.php'; // Pastikan file ini ada dan benar

if ($_GET['proses'] == 'insert') {
    if (isset($_POST['submit'])) {
        $jenjang = mysqli_real_escape_string($db, $_POST['jenjang']);
        $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);

        $sql = "INSERT INTO prodi (jenjang, nama_prodi) VALUES ('$jenjang', '$nama_prodi')";
        $result = mysqli_query($db, $sql);

        if ($result) {
            echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href='index.php?p=prd';</script>";
        } else {
            $error = mysqli_error($db);
            echo "<script>alert('Data Gagal Ditambahkan. Error: " . addslashes($error) . "'); window.location.href='prodi.php';</script>";
        }
    }
}

if ($_GET['proses'] == 'edit') {
    // Pastikan ada ID yang dikirim
    if (!isset($_GET['id'])) {
        header("Location: list_prodi.php");
        exit();
    }

    $id = $_GET['id'];

    // Proses edit jika form disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jenjang = mysqli_real_escape_string($db, $_POST['jenjang']);
        $nama_prodi = mysqli_real_escape_string($db, $_POST['nama_prodi']);

        $query = "UPDATE prodi SET jenjang = '$jenjang', nama_prodi = '$nama_prodi' WHERE id = $id";

        if (mysqli_query($db, $query)) {
            $success_message = "Program Studi berhasil diperbarui";
        } else {
            $error_message = "Gagal memperbarui Program Studi: " . mysqli_error($db);
        }
    }
    // Ambil data prodi berdasarkan ID
    $query = mysqli_query($db, "SELECT * FROM prodi WHERE id = $id");
    $prodi = mysqli_fetch_assoc($query);

    // Jika data tidak ditemukan, kembali ke list_prodi.php
    if (!$prodi) {
        header("Location: list_prodi.php");
        exit();
    }
}
if ($_GET['proses']=='delete') {
    $hapus=mysqli_query($db,"DELETE FROM prodi WHERE id='$_GET[id]'");
    if($hapus){
       header("Location: index.php?p=prd");
    }else{
        echo "<script>alert('Data Gagal Dihapus'); window.location.href='list_mhs.php';</script>";
    }
}

?>
