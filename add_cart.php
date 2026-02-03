<?php
session_start();
$conn = mysqli_connect("localhost","root","","store_db");

$id_produk = $_GET['id'];
$session = session_id();

/* cek sudah ada di cart belum */
$cek = mysqli_query($conn,"SELECT * FROM cart 
WHERE session_id='$session' AND id_produk='$id_produk'");

if(mysqli_num_rows($cek) > 0){
mysqli_query($conn,"UPDATE cart SET qty = qty + 1
WHERE session_id='$session' AND id_produk='$id_produk'");
}else{
mysqli_query($conn,"INSERT INTO cart(session_id,id_produk,qty)
VALUES('$session','$id_produk',1)");
}

header("Location: cart.php");
exit;
?>
