<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dashboard";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo "Koneksi Gagal";
    die();
}
?>