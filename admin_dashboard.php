<?php
session_start();
if(!isset($_SESSION['admin'])){
header("Location: login.php"); exit;
}

$conn = mysqli_connect("localhost","root","","store_db");

$produk = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM produk"));
$order = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM orders"));
$omzet = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total) total FROM orders"));
$sold = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM produk WHERE status='sold'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin — Second Tale</title>

<style>
body{font-family:Arial;background:#f5f2ee;padding:40px}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
max-width:900px;
margin:auto;
}

.card{
background:white;
padding:25px;
border-radius:18px;
box-shadow:0 10px 20px rgba(0,0,0,0.1);
text-align:center;
}

.card h1{margin:0;font-size:38px;color:#5b4a3a}
.card p{margin:8px 0 0;font-size:15px;color:#777}

.menu{
text-align:center;margin-top:40px
}
.menu a{
margin:10px;
display:inline-block;
padding:12px 22px;
border-radius:12px;
background:#5b4a3a;
color:white;
text-decoration:none;
}
</style>
</head>

<body>

<h2 style="text-align:center">📊 Dashboard Second Tale</h2>

<div class="grid">

<div class="card">
<h1><?= $produk['total']; ?></h1>
<p>Total Produk</p>
</div>

<div class="card">
<h1><?= $order['total']; ?></h1>
<p>Total Order</p>
</div>

<div class="card">
<h1>Rp <?= number_format($omzet['total'] ?? 0); ?></h1>
<p>Total Omzet</p>
</div>

<div class="card">
<h1><?= $sold['total']; ?></h1>
<p>Produk Sold Out</p>
</div>

</div>

<div class="menu">
<a href="admin.php">📦 Kelola Produk</a>
<a href="admin_order.php">📥 Order Masuk</a>
<a href="logout.php">🚪 Logout</a>
</div>

</body>
</html>
