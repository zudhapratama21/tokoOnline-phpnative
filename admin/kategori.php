<h2 style="font-color:black;"><i class="fa fa-file"></i> Data Kategori</h2>
<hr>
<?php 
	$semuadata=array();
	$ambil=$koneksi->query("SELECT * FROM kategori");
	while ($tiap=$ambil->fetch_assoc()) {
		$semuadata[]=$tiap;
	}
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key => $value): ?>
		<tr>
			<td><?php echo $key+1; ?></td>
			<td><?php echo $value['nama_kategori'] ?></td>
			<td>
				<a href="index.php?halaman=ubah_kategori&id=<?php echo $value['id_kategori'] ?>" class="btn btn-success "><i class="fas fa-edit"></i> Ubah</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

<a href="" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Data</a>

