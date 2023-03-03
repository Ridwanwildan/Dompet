<?php
include "koneksi.php";
$name = $_POST['name'];
$price = $_POST['price'];
$date = $_POST['date'];
$category = $_POST['category'];
$comment = $_POST['comment'];

$sql = "INSERT INTO income (name, price, date, category, comment) ";
$sql .= "VALUES ('$name', '$price', '$date', '$category', '$comment')";

if (mysqli_query($conn, $sql)) {
    header('location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
