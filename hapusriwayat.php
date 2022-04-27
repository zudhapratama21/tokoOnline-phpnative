<?php 
	session_start();
	$id_produk=$_GET["id"];
	unset ($_SESSION["riwayat"][$id_produk]);

	echo "<script>alert('riwayat sudah dihapus');</script>";
	echo "<script>location='riwayat.php'</script>";

 ?>