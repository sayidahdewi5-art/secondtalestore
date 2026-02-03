<?php
$conn = mysqli_connect("localhost","root","","store_db");

$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM produk WHERE id=$id");
$p = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

$nama=$_POST['nama'];
$harga=$_POST['harga'];
$desk=$_POST['deskripsi'];
$kondisi=$_POST['kondisi'];
$status=$_POST['status'];
$stok=$_POST['stok'];

mysqli_query($conn,"UPDATE produk SET
nama_produk='$nama',
harga='$harga',
deskripsi='$desk',
kondisi='$kondisi',
status='$status',
stok='$stok'
WHERE id=$id");

header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Produk — Second Tale</title>
<style>
body{font-family:Arial;background:#f5f2ee;padding:40px}
form{background:white;padding:25px;border-radius:18px;max-width:600px;margin:auto}
input,textarea,select{width:100%;padding:10px;margin:6px 0}
button{padding:12px 20px;border:none;border-radius:10px;background:#5b4a3a;color:white}
</style>
</head>

<body>

<h2>Edit Produk</h2>

<form method="post">

<input type="text" name="nama" value="<?= $p['nama_produk']; ?>" required>
<input type="number" name="harga" value="<?= $p['harga']; ?>" required>

<textarea name="deskripsi"><?= $p['deskripsi']; ?></textarea>

<input type="text" name="kondisi" value="<?= $p['kondisi']; ?>">

<input type="number" name="stok" value="<?= $p['stok']; ?>">

<select name="status">
<option value="ready" <?= $p['status']=="ready"?'selected':''; ?>>READY</option>
<option value="sold" <?= $p['status']=="sold"?'selected':''; ?>>SOLD</option>
</select>

<button name="update">Update Produk</button>

</form>

<br>
<a href="admin.php">⬅ Kembali</a>

</body>
</html>
