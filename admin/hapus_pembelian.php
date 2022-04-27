<?php 
	$ambil=$koneksi->query("SELECT * FROM pembelian LEFT JOIN pembelian_produk ON  pembelian.id_pembelian=pembelian_produk.id_pembelian ");
	$pecah=$ambil->fetch_assoc();

	$koneksi->query("DELETE FROM pembelian_produk WHERE id_pembelian='$_GET[id]'");
	$koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$_GET[id]'");
	
	echo "<script>alert('pembelia terhapus');</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";
 ?>