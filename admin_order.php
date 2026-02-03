<?php
session_start();
if(!isset($_SESSION['admin'])){
header("Location: login.php"); exit;
}

$conn = mysqli_connect("localhost","root","","store_db");

$data = mysqli_query($conn,"SELECT * FROM orders ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Masuk — Second Tale</title>
<style>
body{font-family:Arial;background:#f5f2ee;padding:40px}
table{background:white;width:100%;padding:20px;border-radius:18px}
td,th{padding:10px;text-align:left}
</style>
</head>

<body>

<h2>📥 ORDER MASUK</h2>

<table border="1">
<tr>
<th>Produk</th>
<th>Qty</th>
<th>Total</th>
<th>Waktu</th>
</tr>

<?php while($o=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $o['nama_produk']; ?></td>
<td><?= $o['qty']; ?></td>
<td>Rp <?= number_format($o['total']); ?></td>
<td><?= $o['waktu']; ?></td>
</tr>
<?php endwhile; ?>

</table>

<br>
<a href="admin.php">⬅ Kembali Admin</a>

</body>
</html>
