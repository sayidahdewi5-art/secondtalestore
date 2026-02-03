<?php
session_start();
if(!isset($_SESSION['admin'])){
header("Location: login.php");
exit;
}

$conn = mysqli_connect("localhost","root","","store_db");

/* ================= TAMBAH PRODUK ================= */
if(isset($_POST['tambah'])){

$nama=$_POST['nama'];
$harga=$_POST['harga'];
$desk=$_POST['deskripsi'];
$kondisi=$_POST['kondisi'];
$status=$_POST['status'];
$stok=$_POST['stok'];

$f1=$_FILES['foto1']['name'];
$f2=$_FILES['foto2']['name'];
$f3=$_FILES['foto3']['name'];

move_uploaded_file($_FILES['foto1']['tmp_name'],"assets/img/".$f1);
move_uploaded_file($_FILES['foto2']['tmp_name'],"assets/img/".$f2);
move_uploaded_file($_FILES['foto3']['tmp_name'],"assets/img/".$f3);

mysqli_query($conn,"INSERT INTO produk
(nama_produk,harga,gambar,foto2,foto3,deskripsi,kondisi,status,stok)
VALUES
('$nama','$harga','$f1','$f2','$f3','$desk','$kondisi','$status','$stok')
");

header("Location: admin.php");
exit;
}

/* ================= HAPUS PRODUK ================= */
if(isset($_GET['hapus'])){
$id=$_GET['hapus'];
mysqli_query($conn,"DELETE FROM produk WHERE id=$id");
header("Location: admin.php");
exit;
}

/* ================= DATA ================= */
$data=mysqli_query($conn,"SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin — Second Tale</title>
<style>
body{font-family:Arial;background:#f5f2ee;padding:40px}
form,table{background:white;padding:25px;border-radius:18px;margin-bottom:30px}
input,textarea,select{width:100%;padding:10px;margin:6px 0}
button{padding:12px 20px;border:none;border-radius:10px;background:#5b4a3a;color:white}
table{width:100%}
td{padding:10px}
a{color:#5b4a3a;text-decoration:none;font-weight:bold}
</style>
</head>

<body>

<h2>➕ Tambah Produk</h2>

<form method="post" enctype="multipart/form-data">

<input type="text" name="nama" placeholder="Nama produk" required>
<input type="number" name="harga" placeholder="Harga" required>

<label>Foto 1</label>
<input type="file" name="foto1" required>

<label>Foto 2</label>
<input type="file" name="foto2">

<label>Foto 3</label>
<input type="file" name="foto3">

<textarea name="deskripsi" placeholder="Deskripsi lengkap"></textarea>

<input type="text" name="kondisi" placeholder="Kondisi (Like New / Good)">

<input type="number" name="stok" placeholder="Stok" value="1" required>

<select name="status">
<option value="ready">READY</option>
<option value="sold">SOLD</option>
</select>

<button name="tambah">Tambah Produk</button>

</form>

<h2>📦 Data Produk</h2>

<table border="1">
<?php while($p=mysqli_fetch_assoc($data)): ?>
<tr>
<td><?= $p['nama_produk']; ?></td>
<td>Rp <?= number_format($p['harga']); ?></td>
<td>Stok: <?= $p['stok']; ?></td>
<td><?= strtoupper($p['status']); ?></td>
<td>
<a href="edit.php?id=<?= $p['id']; ?>">Edit</a> |
<a href="?hapus=<?= $p['id']; ?>" onclick="return confirm('Hapus produk?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="logout.php">LOGOUT</a>

</body>
</html>
