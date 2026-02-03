<?php
$conn = mysqli_connect("localhost","root","","store_db");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM keranjang WHERE id=$id");

header("Location: cart.php");
