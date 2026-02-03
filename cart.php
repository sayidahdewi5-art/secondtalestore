<?php
session_start();
$conn = mysqli_connect("localhost","root","","store_db");
$session = session_id();

/* hapus item */
if(isset($_GET['hapus'])){
$id=$_GET['hapus'];
mysqli_query($conn,"DELETE FROM cart WHERE id=$id AND session_id='$session'");
header("Location: cart.php");
exit;
}

$data = mysqli_query($conn,"
SELECT cart.*, produk.nama_produk, produk.harga, produk.gambar, produk.stok
FROM cart
JOIN produk ON cart.id_produk = produk.id
WHERE cart.session_id='$session'
");

$total=0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Cart — Second Tale</title>
<style>
body{font-family:Arial;background:#f5f2ee;padding:40px}
.box{max-width:900px;margin:auto;background:white;padding:30px;border-radius:20px}
.item{display:flex;gap:20px;margin-bottom:20px}
img{width:120px;border-radius:12px}
.btn{padding:12px 20px;background:#5b4a3a;color:white;text-decoration:none;border-radius:10px}
.remove{color:red}
</style>
</head>

<body>

<div class="box">
<h2>🛒 Keranjang</h2>

<?php while($p=mysqli_fetch_assoc($data)): 
$subtotal = $p['harga'] * $p['qty'];
$total += $subtotal;
?>

<div class="item">
<img src="assets/img/<?= $p['gambar']; ?>">
<div>
<b><?= $p['nama_produk']; ?></b><br>
Qty: <?= $p['qty']; ?><br>
Rp <?= number_format($subtotal); ?><br>
<a class="remove" href="?hapus=<?= $p['id']; ?>">Hapus</a>
</div>
</div>

<?php endwhile; ?>

<hr>
<h3>Total: Rp <?= number_format($total); ?></h3>

<a class="btn" href="checkout.php">Checkout</a>
<br><br>
<a href="index.php">⬅ Kembali belanja</a>

</div>

</body>
</html>
