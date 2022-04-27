<!DOCTYPE html>
<html>
<head>
	<style>
	.box{
		width: 200px;
		height: 150px;
	    padding: 10px;
	    border-radius:17px;
	    color: #EFEFEF;
	    font-family: Arial Rounded MT;
  }
	</style>
</head>
<body>



<h2 class="text center"><b>Selamat Datang Admin</b></h2>
<hr>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3" href="">
				<?php 
					$produk=$koneksi->query("SELECT * FROM produk");
					$data=$produk->num_rows;
				 ?>
				 <div class="box" style="background-color: #5BB8FF">
				 	<h3>Jumlah <br>Produk</h3>
					<h1 style="padding-left:150px"><?php echo $data ?></h1>
				</div>
			</div>
			<div class="col-md-3">
				<?php 
					$jumlah=$koneksi->query("SELECT * FROM pelanggan");
					$plgn=$jumlah->num_rows;
				 ?>
				 <div class="box" style="background-color: #18DFA9">
				 <h3>Jumlah Pelanggan</h3>
				 <h1 style="padding-left:150px"><?php echo $plgn ?></h1>
				 </div>
			</div>
			<div class="col-md-3">
				<?php 
				$jumlah=$koneksi->query("SELECT * FROM pembelian WHERE status_pembelian != 'pending'");
				$pbn=$jumlah->num_rows;
				 ?>
				 <div class="box" style="background-color: #A0D1B7">
				 <h3>Jumlah Pembeli</h3>
				 <h1  style="padding-left:150px"><?php echo $pbn ?></h1>

				 </div>
			</div>
		</div>
		<div class="row" style="margin-top: 10px">
			<div class="col-md-3">
				<?php 
					$jumlah=$koneksi->query("SELECT * FROM kategori");
					$ktgr=$jumlah->num_rows;
				 ?>
				 <div class="box" style="background-color: #20DAE8">
				 <h3>Jumlah Kategori</h3>
				 <h1 style="padding-left:150px"><?php echo $ktgr ?></h1>
				 </div>			 
			</div>
	</div>
</section>

<h4 class="alert alert-info"> <b>Data pelanggan yang baru saja membayar</b></h4>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Jumlah</th>
			<th>Bank</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php $nomor=1; ?>
			<?php $ambil=$koneksi->query("SELECT * FROM pembayaran  ORDER BY id_pembayaran DESC LIMIT 4 ") ?>
			<?php while($pecah=$ambil->fetch_assoc()){ ?>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama'] ?></td>
			<td><?php echo $pecah['jumlah'] ?></td>
			<td><?php echo $pecah['bank'] ?></td>
			<td><?php echo $pecah['tanggal'] ?></td>
		</tr>
			<?php  $nomor++?>
			<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=pembelian" class="btn btn-success"> Detail Pembelian <i class="fas fa-angle-double-right"></i></a>

<h4 class="alert alert-info"> <b>Data pelanggan yang baru saja membeli</b></h4>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Tanggal Pembelian</th>
			<th>Status pembelian</th>
			<th>Total pembelian</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php $nomor=1; ?>
			<?php $ambil=$koneksi->query(" SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan ORDER BY id_pembelian DESC LIMIT 5"); ?>
			<?php while($data=$ambil->fetch_assoc()){ ?>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $data['nama_pelanggan'] ?></td>
			<td><?php echo $data['tanggal_pembelian'] ?></td>
			<td><?php echo $data['status_pembelian'] ?></td>
			<td><?php echo $data['total_pembelian'] ?></td>
		</tr>
			<?php  $nomor++?>
			<?php } ?>
	</tbody>
</table>
<a href="index.php?halaman=pembelian" class="btn btn-success"> Detail Pembelian <i class="fas fa-angle-double-right"></i></a>

<h4 class="alert alert-info"> <b>Data produk yang baru </b></h4>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Stok</th>
			<th>Berat</th>	
			<th>Foto</th>	
			<th>Aksi</th>
		</tr>
	</thead>
<tbody>
	<?php $nomor=1; ?>
	<?php $ambil=$koneksi->query("SELECT * FROM produk LEFT JOIN kategori  ON produk.id_kategori=kategori.id_kategori ORDER BY id_produk DESC LIMIT 5") ?>
	<?php while($pecah=$ambil->fetch_assoc()){ ?>
	<tr>
		<td><?php echo $nomor ?></td>
		<td><?php echo $pecah["nama_kategori"]; ?></td>
		<td><?php echo $pecah['nama_produk'] ?></td>
		<td><?php echo $pecah['harga_produk'] ?></td>
		<td><?php echo $pecah['stok_produk'] ?></td>
		<td><?php echo $pecah['berat_produk']?></td>
		<td>
			<img src="../foto_produk/<?php echo $pecah['foto_produk']?>" width="70px">
		</td>
		<td>
			<a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk'];?>" class="btn-danger btn"> <i class="fa fa-trash"></i> hapus</a>
			<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk'];?>" class="btn btn-warning"><i class="fa fa-edit"></i> ubah</a>

		</td>
	</tr>
	<?php  $nomor++?>
	<?php } ?>
</tbody>
</table>
<a href="index.php?halaman=pembelian" class="btn btn-success"> Detail Produk <i class="fas fa-angle-double-right"></i></a>
</body>
</html>