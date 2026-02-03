<?php
$conn = mysqli_connect("localhost","root","","store_db");

$id = $_GET['id'];
$act = $_GET['act'];

if($act=="plus"){
  mysqli_query($conn,"UPDATE keranjang SET qty=qty+1 WHERE id=$id");
}

if($act=="minus"){
  mysqli_query($conn,"UPDATE keranjang SET qty=qty-1 WHERE id=$id");
  mysqli_query($conn,"DELETE FROM keranjang WHERE qty<=0");
}

header("Location: cart.php");
