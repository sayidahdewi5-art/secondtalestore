<?php
session_start();
$conn = mysqli_connect("localhost","root","","store_db");
$session = session_id();

/* ambil cart */
$data = mysqli_query($conn,"
SELECT cart.*, produk.id AS pid, produk.stok, produk.nama_produk, produk.harga
FROM cart
JOIN produk ON cart.id_produk = produk.id
WHERE cart.session_id='$session'
");

$pesan = "Halo Second Tale,%0ASaya mau order:%0A%0A";
$total = 0;

/* kurangi stok + buat pesan */
while($p=mysqli_fetch_assoc($data)){
$subtotal = $p['harga'] * $p['qty'];
$total += $subtotal;

$pesan .= "- ".$p['nama_produk']." (".$p['qty']." pcs)%0A";

$sisa = $p['stok'] - $p['qty'];
if($sisa <= 0){
mysqli_query($conn,"UPDATE produk SET stok=0, status='sold' WHERE id=".$p['pid']);
}else{
mysqli_query($conn,"UPDATE produk SET stok=$sisa WHERE id=".$p['pid']);
}
}

$pesan .= "%0ATotal: Rp ".number_format($total)."%0A";

mysqli_query($conn,"INSERT INTO orders(session_id,detail,total)
VALUES('$session','$pesan','$total')");

/* kosongkan cart */
mysqli_query($conn,"DELETE FROM cart WHERE session_id='$session'");

/* redirect WA */
header("Location: https://wa.me/6281393176851?text=".$pesan);
exit;
?>
