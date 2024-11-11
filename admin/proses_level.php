<?php
include 'koneksi.php';

if(isset($_GET['proses']) && $_GET['proses'] == 'edit') {
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $level_id = $_POST['level_id'];
        
        // Validasi level_id harus 0 atau 1
        if($level_id == '0' || $level_id == '1') {
            $query = mysqli_query($db, "UPDATE user SET level_id = '$level_id' WHERE id = '$id'");
            
            if($query) {
                echo "<script>
                    alert('Level user berhasil diupdate!');
                    window.location.href='index.php?p=level';
                </script>";
            } else {
                echo "<script>
                    alert('Level user gagal diupdate!');
                    window.location.href='index.php?p=level&aksi=edit&id=".$id."';
                </script>";
            }
        } else {
            echo "<script>
                alert('Level tidak valid!');
                window.location.href='index.php?p=level&aksi=edit&id=".$id."';
            </script>";
        }
    }
} else {
    header("Location: index.php?p=level");
}
?>
