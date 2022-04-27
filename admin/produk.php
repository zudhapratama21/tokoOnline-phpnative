<h2><i class="fa fa-home"></i> Data Produk </h2>
<hr>

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
	<?php $ambil=$koneksi->query("SELECT * FROM produk LEFT JOIN kategori  ON produk.id_kategori=kategori.id_kategori") ?>
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
<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah data</a>