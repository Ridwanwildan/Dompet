<?php
// Mengkoneksikan ke database
include "koneksi.php";

// Menerima data dari form
$name = $_POST['name'];
$price = $_POST['price'];
$date = $_POST['date'];

// Query untuk menambahkan data ke database
$sql = "INSERT INTO transaction (name, price, date) VALUES ('$name', '$price', '$date')";

if (mysqli_query($conn, $sql)) {
    header('location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Menutup koneksi
mysqli_close($conn);
?>