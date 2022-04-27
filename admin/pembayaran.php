<h1>Data pembayaran</h1>

<?php 
	
	$id_pembelian=$_GET['id'];
	//mengambil data pembayaran berdasarkan idpembelian

	$ambil=$koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
	$detail=$ambil->fetch_assoc();
 ?>
 <section>
 
 <div class="row">
 	<div class="col-md-6">
 		<table class="table">
 			<tr>
 				<th>Nama</th>
 				<td><?php echo $detail['nama'] ?></td>
 			</tr>
 			<tr>
 				<th>Bank</th>
 				<td><?php echo $detail['bank'] ?></td>
 			</tr>
 			<tr>
 				<th>Jumlah</th>
 				<td>Rp.<?php echo number_format($detail['jumlah']) ?></td>
 			</tr>
 			<tr>
 				<th>tanggal</th>
 				<td><?php echo $detail['tanggal'] ?></td>
 			</tr>
 		</table>
 	</div>
 	<div class="col-md-6">
 		<img style="width: 200px;height: 200px" src="../bukti pembayaran/<?php echo $detail['bukti']?>">
 	</div>
 	
 </div>
 </section>

 <form method="POST">
 	<div class="form-group">
 		<label>No Resi Pengiriman</label>
 		<input type="text" name="resi" class="form-control">
 	</div>
 	<div class="form-group">
 		<label>Status</label>
 		<select class="form-control" name="status">
 			<option >pilih status</option>
 			<option value="Lunas">Lunas</option>
 			<option value="barang dikirim"> Barang dikirim</option>
 			<option value="batal">Batal</option>
 		</select>
 	</div>
 	<button class="btn btn-primary" name="proses">Proses</button>
 </form>
 <?php 

 	if(isset($_POST['proses'])){

 		$resi=$_POST['resi'];
 		$status=$_POST['status'];
 		$koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi',status_pembelian='$status' WHERE id_pembelian='$id_pembelian' ");

 		echo "<script>alert('data pembelian terupdate')</script>";
 		echo "<script>location='index.php'</script>";
 	}

  ?>

