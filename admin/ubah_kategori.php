<h2>Ubah Kategori</h2>
<?php 
	
	$ambil=$koneksi->query("SELECT * FROM kategori  where id_kategori='$_GET[id]'");
	$data=$ambil->fetch_assoc();
 ?>
 
  <form method="POST" enctype="multipart/form-data">
  		<div class="form-group">
  			<label>Nama kategori</label>
  			<input type="text" name="nama" class="form-control" value="<?php echo $data['nama_kategori']; ?> ">
  		</div>
  		<button class="btn btn-primary" name="ubah">Ubah</button>
  </form>
  <?php 
  			if (isset($_POST['ubah'])) {
  				$koneksi->query("UPDATE kategori SET nama_kategori='$_POST[nama]' WHERE id_kategori='$_GET[id]'");
  				echo "<script>alert('data telah diubah');</script>";
  				echo "<script>location='index.php?halaman=kategori';</script>";
  			}
  			
  ?>
