<?php 
session_start();
//mendapatkan id prduk
$id_produk=$_GET['id'];

//jika sudah ada produk itu dikeranjang maka produk di +1
if (isset($_SESSION['keranjang'][$id_produk])) {
	$_SESSION['keranjang'][$id_produk]+=1;
}
//jika belum , maka dianggap dibeli 1
else{
	$_SESSION['keranjang'][$id_produk]=1;
}
//larikan ke halaman keranjang
echo "<script>alert('produk telak masuk ke keranjang belanja');</script>";
echo "<script>location = 'keranjang.php';</script>";
 ?>
