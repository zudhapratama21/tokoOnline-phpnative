<h2><i class="fa fa-user"></i> Data Pelanggan </h2>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama pelanggan</th>
			<th>Email</th>
			<th>Telepon</th>
			<th>Alamat</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php  $ambil=$koneksi->query("SELECT * FROM pelanggan WHERE level!='admin'") ?>
		<?php while($pecah=$ambil->fetch_assoc()) {?>
    <tr>
		<td><?php echo $nomor;?></td>
		<td><?php echo $pecah['nama_pelanggan'] ?></td>
		<td><?php echo $pecah['email_pelanggan'] ?></td>
		<td><?php echo $pecah['telepon_pelanggan'] ?></td>
		<td><?php echo $pecah['alamat_pelanggan'] ?></td>
		<td>
			<a href="" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
		</td>
	</tr>
		<?php $nomor++;?>
		<?php } ?>
	</tbody>
</table>