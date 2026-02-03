<?php
$conn = mysqli_connect("localhost","root","","store_db");

$data = mysqli_query($conn,"SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>SECOND TALE — Preloved From US</title>

<style>
body{margin:0;font-family:Arial;background:#f5f2ee}

header{
background:linear-gradient(90deg,#3e2f23,#6a523c);
color:white;padding:18px 30px;
display:flex;justify-content:space-between;align-items:center
}
.logo{font-size:24px;font-weight:bold;letter-spacing:2px}

nav a{
color:white;text-decoration:none;margin-left:20px;font-weight:bold
}

.grid{
display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
gap:25px;padding:40px;max-width:1200px;margin:auto
}

.card{
background:white;border-radius:22px;overflow:hidden;
box-shadow:0 10px 20px rgba(0,0,0,0.08)
}
.card img{width:100%;height:280px;object-fit:cover}

.box{padding:18px}
.card h3{margin:0}

.price{color:#5b4a3a;font-weight:bold;margin:8px 0}
.status{font-size:13px;color:#888}

.btn{
display:block;margin-top:12px;padding:10px;text-align:center;
background:#5b4a3a;color:white;border-radius:12px;text-decoration:none
}
.btn.sold{background:#999;pointer-events:none}

footer{
background:#eee;padding:40px;text-align:center;margin-top:40px
}
</style>
</head>

<body>

<header>
<div class="logo">SECOND TALE</div>
<nav>
<a href="index.php">Shop</a>
<a href="about.php">About</a>
</nav>
</header>

<div class="grid">
<?php while($p=mysqli_fetch_assoc($data)): ?>

<div class="card">

<a href="detail.php?id=<?= $p['id']; ?>">
<img src="assets/img/<?= $p['gambar']; ?>">
</a>

<div class="box">

<h3><?= $p['nama_produk']; ?></h3>

<div class="price">Rp <?= number_format($p['harga']); ?></div>

<div class="status"><?= $p['kondisi']; ?> • <?= strtoupper($p['status']); ?></div>

<?php if($p['status']=="sold"): ?>
<a class="btn sold">SOLD OUT</a>
<?php else: ?>
<a class="btn"
href="https://wa.me/6281393176851?text=Halo%20Second%20Tale,%20saya%20tertarik%20dengan%20<?= urlencode($p['nama_produk']); ?>,%20apakah%20masih%20ready?"
target="_blank">Buy via WhatsApp</a>
<?php endif; ?>

</div>
</div>

<?php endwhile; ?>
</div>

<footer>
© <?= date("Y"); ?> SECOND TALE — Preloved from US with love 🤍
</footer>

</body>
</html>
