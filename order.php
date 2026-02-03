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
<title>Order — Second Tale</title>
<style>
body{font-family:Arial;background:#f5f2ee;padding:40px}
.box{background:white;padding:25px;border-radius:18px;margin-bottom:20px}
</style>
</head>

<body>

<h2>📦 Riwayat Order</h2>

<?php while($o=mysqli_fetch_assoc($data)): ?>
<div class="box">
<b>Order #<?= $o['id']; ?></b><br>
<?= nl2br($o['detail']); ?><br>
<b>Total:</b> Rp <?= number_format($o['total']); ?><br>
<small><?= $o['created_at']; ?></small>
</div>
<?php endwhile; ?>

<a href="admin.php">⬅ Back</a>

</body>
</html>
