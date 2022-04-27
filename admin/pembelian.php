<h2><i class="fa fa-shopping-cart"></i> Data pembelian</h2>
<hr>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th> 
			<th>nama Pelanggan</th>
			<th>Tanggal Pembelian</th>
			<th>Status Pembelian</th>
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query(" SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
			<tr>
				<td><?php echo $nomor;?></td>
				<td><?php echo $pecah['nama_pelanggan'] ?></td>
				<td><?php echo $pecah['tanggal_pembelian'] ?></td>
				<td><?php echo $pecah['status_pembelian'] ?></td>
				<td><?php echo number_format($pecah['total_pembelian'])  ?></td>
				<td>
					<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info"> <i class="fas fa-file"></i> Detail</a>
					<?php if($pecah['status_pembelian']!=="pending"): ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-success"><i class="fas fa-tags"></i> Pembayaran</a>
					<?php endif ?>
					<a href="index.php?halaman=hapus_pembelian&id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
				</td>
			</tr>
			<?php $nomor++ ?>
		<?php } ?>
	</tbody>
</table>