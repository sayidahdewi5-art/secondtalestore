<?php
$conn = mysqli_connect("localhost","root","","store_db");

$id = $_GET['id'];
$data = mysqli_query($conn,"SELECT * FROM produk WHERE id=$id");
$p = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $p['nama_produk']; ?> — Second Tale</title>

<style>
body{font-family:Arial;background:#f5f5f5;padding:40px}
.box{
max-width:900px;margin:auto;background:white;padding:30px;border-radius:18px;
display:flex;gap:30px;flex-wrap:wrap
}
img{width:100%;border-radius:18px}
.left{width:350px}
.thumb{display:flex;gap:10px;margin-top:10px}
.thumb img{width:100px;cursor:pointer}
.btn{
background:black;color:white;padding:12px 20px;text-decoration:none;border-radius:10px;
display:inline-block;margin-top:10px
}
</style>

<script>
function ganti(src){
document.getElementById("utama").src=src;
}
</script>
</head>

<body>

<div class="box">

<div class="left">
<img id="utama" src="assets/img/<?= $p['gambar']; ?>">

<div class="thumb">
<?php if($p['gambar']){ ?><img onclick="ganti(this.src)" src="assets/img/<?= $p['gambar']; ?>"><?php } ?>
<?php if($p['foto2']){ ?><img onclick="ganti(this.src)" src="assets/img/<?= $p['foto2']; ?>"><?php } ?>
<?php if($p['foto3']){ ?><img onclick="ganti(this.src)" src="assets/img/<?= $p['foto3']; ?>"><?php } ?>
</div>
</div>

<div>
<h2><?= $p['nama_produk']; ?></h2>
<h3>Rp <?= number_format($p['harga']); ?></h3>
<p><b>Kondisi:</b> <?= $p['kondisi']; ?></p>
<p><?= nl2br($p['deskripsi']); ?></p>
<p><b>Stok:</b> <?= $p['stok']; ?></p>

<?php if($p['stok']<=0): ?>
<b style="color:red">SOLD OUT</b>
<?php else: ?>
<a class="btn" href="add_cart.php?id=<?= $p['id']; ?>">Add to Cart</a>
<?php endif; ?>

<br><br>
<a href="index.php">⬅ Kembali</a>
</div>

</div>

</body>
</html>
