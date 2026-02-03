<?php
$conn = mysqli_connect("localhost","root","","store_db");

$data = mysqli_query($conn,"
SELECT k.*, p.stok, p.nama_produk
FROM keranjang k
JOIN produk p ON k.produk_id=p.id
");

$msg="Halo Second Tale, saya mau checkout:%0A";

while($p=mysqli_fetch_assoc($data)){

if($p['stok'] < $p['qty']){
echo "Stok ".$p['nama_produk']." tidak cukup 😢";
exit;
}

mysqli_query($conn,"
UPDATE produk SET stok=stok-".$p['qty']." WHERE id=".$p['produk_id']);

$msg .= "- ".$p['nama_produk']." (".$p['qty'].")%0A";
}

mysqli_query($conn,"UPDATE produk SET status='sold' WHERE stok<=0");
mysqli_query($conn,"DELETE FROM keranjang");

header("Location: https://wa.me/6281393176851?text=$msg");
exit;
?>
