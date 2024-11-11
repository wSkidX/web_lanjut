<?php
    $db = mysqli_connect("localhost", "root", "", "db_tekom2a");
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
