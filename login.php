<?php
session_start();
$conn = mysqli_connect("localhost","root","","store_db");

if(isset($_POST['login'])){
$user = $_POST['user'];
$pass = $_POST['pass'];

$cek = mysqli_query($conn,"SELECT * FROM admin 
WHERE username='$user' AND password='$pass'");

if(mysqli_num_rows($cek)>0){
$_SESSION['admin'] = $user;
header("Location: admin.php");
}else{
$err = "Username / Password salah!";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Admin — Second Tale</title>
<style>
body{background:#f5f2ee;font-family:Arial}
.box{
max-width:400px;margin:120px auto;
background:white;padding:40px;border-radius:20px;
text-align:center;box-shadow:0 15px 30px rgba(0,0,0,.1)
}
input{width:100%;padding:12px;margin:10px 0}
button{
padding:12px;width:100%;
background:#5b4a3a;color:white;border:none;border-radius:10px
}
.err{color:red;margin-top:10px}
</style>
</head>

<body>

<div class="box">
<h2>ADMIN LOGIN</h2>

<form method="post">
<input type="text" name="user" placeholder="Username" required>
<input type="password" name="pass" placeholder="Password" required>
<button name="login">LOGIN</button>
</form>

<?php if(isset($err)) echo "<div class='err'>$err</div>"; ?>

</div>

</body>
</html>
