<?php 
$semuadata=array();
$tgl_mulai="-";
$tgl_sls="-";

	if (isset($_POST["kirim"])) {

		$tgl_mulai=$_POST["tglm"];
		$tgl_sls=$_POST['tgls'];
		$ambil=$koneksi->query("SELECT * FROM pembelian pm LEFT JOIN pelanggan pl ON pm.id_pelanggan=pl.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_sls'");
		while ($pecah=$ambil->fetch_assoc()) {
			$semuadata[]=$pecah;
		}
	}
 ?>

<h2><i class="fa fa-file"></i> Laporan Pembelian dari	<?php echo $tgl_mulai ?> hingga <?php echo $tgl_sls ?></h2>
<hr>

<form method="POST">
	<div class="row">
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal Mulai</label>
				<input type="date" name="tglm" class="form-control" value="<?php echo $tgl_mulai ?>">
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label>Tanggal selesei</label>
				<input type="date" name="tgls" class="form-control" value="<?php echo $tgl_sls ?>">
			</div>
		</div>
		<div class="col-md-2">
			<label>&nbsp;</label><br>
			<button class="btn btn-primary" name="kirim">Lihat</button>
		</div>
	</div>
</form>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Pelanggan</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php $total=0; ?>

		<?php foreach ($semuadata as $key => $value): ?>
		<?php $total+=$value['total_pembelian']; ?>
		
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_pelanggan"]; ?></td>
			<td><?php echo $value["tanggal_pembelian"]; ?></td>
			<td><?php echo number_format($value["total_pembelian"]) ?></td>
			<td><?php echo $value['status_pembelian'] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="3"><b>Total</b></th>
			<td><b>Rp.<?php echo number_format($total); ?></b></td>
			<th></th>
		</tr>
	</tfoot>
</table>