<?php
    $db = mysqli_connect("localhost", "root", "", "mahasiswa");
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
