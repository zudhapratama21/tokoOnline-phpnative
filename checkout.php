<?php 
session_start();
include 'koneksi.php';
print_r($_SESSION);

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])) {
	echo "<script>alert('keranjang kosong,silahkan berbelanja!!');</script>";
	echo "<script>location='index.php';</script>";
}
 if (!isset($_SESSION['pelanggan']) )  {

    echo "<script>alert('Anda harus Login');</script>";
    echo "<script>location='login.php';</script>";
    exit();}	
$tiap=array();
  $ambil=$koneksi->query("SELECT * FROM kategori ");
  while ($data=$ambil->fetch_assoc()) {
    $tiap[]=$data;
  }

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Bakoelbarang.id</title>
 	<link rel="stylesheet" type="text/css" href="admin/assets/css/boostrap.css">
 	<link rel="stylesheet" type="text/css" href="page1.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">
    
 </head>
 <style >
 	html{
        position: relative;
      }
      body{
        margin-bottom: 300px;
      }
      footer{
        position: absolute;
        bottom:0px;
        height: 300px;
        width: 100%;
        background-color:#07BE9F;
      }
 </style>
 <body>
 <nav class="navbar navbar-expand-lg navbar-light" style="background-color :#35C8B4;">
  <a class="navbar-brand" href="#" style="color:white;">BakoelBarang.id</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php" style="color:white;"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-shopping-basket"></i> Produk
        </a>
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-image:linear-gradient(#0F8BAB,#20CF9F,#FFFFFF);color:white">
          <a class="dropdown-item" href="kategori.php?id=<?php echo $tiap[0]['id_kategori'] ?>">elektronik</a>
          <a class="dropdown-item" href="kategori.php?id=<?php echo $tiap[1]['id_kategori'] ?>">makanan & minuman</a>
         <a class="dropdown-item" href="kategori.php?id=<?php echo $tiap[2]['id_kategori'] ?>">Fashion</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="riwayat.php" style="color:white;"><i class="fas fa-bookmark"></i> Riwayat</a>    
    </li>
    </ul>
    <form class="form-inline my-6 my-lg-2" action="pencarian.php" method="GET">
      <input class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search" name="keyword">
      <button class="btn btn-success my-4 my-sm-0" type="submit">Search</button>
    </form>
    

    <li class="form-inline my-4 my-lg-0 " >
        <a class="nav-link " href="keranjang.php" style="color:white;" > <i class="fas fa-shopping-cart"></i></a>    
    </li>
    <?php if (isset($_SESSION['pelanggan'])): ?>
      <li class="form-inline my-4 my-lg-0 " >
        <a class="nav-link btn btn-outline-danger " href="logout.php"  style="border-radius: 15px" ><i class="fas fa-sign-out-alt"></i></a>    
    </li>
    <?php else: ?>
      <li class="form-inline my-4 my-lg-0 " >
        <a class="nav-link btn btn-outline-primary " href="login.php"  style="border-radius: 15px" ><i class="fas fa-sign-out-alt"></i>Login </a>    
    </li>
    <?php endif ?>
   
  </div>
</nav>
<section class="konten"> 
	<div class="container" style="margin-bottom: 350px;margin-top:50px;">
		<h1 style="color:#04B79E "><i class="fas fa-user-tag"></i>Checkout Belanja</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Produk</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subharga</th>
					
				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja=0 ?>
				<?php foreach($_SESSION["keranjang"] as $id_produk =>$jumlah): ?>
				<!-- menampilkan produk yang diperulangkkan berdasarkan id produk -->
				<?php  
					$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");

					$pecah=$ambil->fetch_assoc();
					$subharga=$pecah["harga_produk"]*$jumlah;
					?>
						
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"];?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]);  ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga); ?></td>
				</tr>
				<?php $totalbelanja+=$subharga ?>
				<?php $nomor++; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot>
					<tr>
						<th colspan="4">Total Belanja</th>
						<th>Rp <?php echo number_format($totalbelanja); ?></th>
					</tr>
			</tfoot>
			
		</table>
		<form method="POST">			
				
			<div class="row">
					<div class="col-md-4">
						<div class="form-group">
					<b>Nama Pelanggan:</b> <input type="text" name="" class="form-control" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']?>" >
						
					</div>
			</div>
				<div class="col-md-4">
					<div class="form-group">
				<b>Nomor Telepon:</b> <input type="text" name="" class="form-control" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?>" >
					</div>
				</div>
				<div class="col-md-4">\
					<select class="form-control" name="id_ongkir">
						<option value="">Pilih ongkir</option>	
						<?php 
						$ambil=$koneksi->query("SELECT * FROM ongkir");
						while ($perongkir=$ambil->fetch_assoc()) {
						 ?>	

						<option value="<?php echo $perongkir['id_ongkir']  ?>">
							<?php echo $perongkir['nama_kota']; ?>
							=<?php echo "Rp.".number_format($perongkir ['tarif']); ?>
						</option>
						<?php } ?>
					</select>
				</div>
				
			</div>
			<div class="form-group">
				<label>  <b>Alamat pengiriman</b></label>
				<textarea class="form-control" name="alamat_pengiriman" placeholder="masukan alamat pengiriman anda"></textarea>
			</div>
			<button class="btn btn-danger" style="border-radius:17px;" name="checkout"><i class="fas fa-tags"></i> Checkout</button>
				
		</form>
		<?php  
			if (isset($_POST['checkout'])) {
				$id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir=$_POST["id_ongkir"];
				$tanggal_pembelian=date("Y-m-d");
				$alamat_pengiriman=$_POST['alamat_pengiriman'];
				$ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");

				$arrayongkir=$ambil->fetch_assoc();
				$nama_kota=$arrayongkir['nama_kota'];
				$tarif=$arrayongkir['tarif'];


				$total_pembelian=$totalbelanja+$tarif;
				$koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

				//mendapatkan id pembelian 
				$id_pembelian_barusan=$koneksi->insert_id;
				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {

						//mendapatkan data produk berdasarkan id_produk
						$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");

						$perproduk=$ambil->fetch_assoc();

						$nama = $perproduk['nama_produk'];
						$harga = $perproduk['harga_produk'];
						$berat = $perproduk['berat_produk'];
						$subberat = $perproduk['berat_produk'] * $jumlah ;
						$subharga = $perproduk['harga_produk'] * $jumlah ;

						$koneksi->query("INSERT INTO pembelian_produk(id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')"); 

				//script update stok
					$koneksi->query("UPDATE produk SET stok_produk=stok_produk-$jumlah WHERE id_produk='$id_produk'");

				}

				//mengkosongkan keranjang belanja
				unset($_SESSION['keranjang']);
				//tampilan dialihkan ke halaman nota;
				echo "<script>alert('pembelian sukses');</script>";
				echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
			}
		?>
	</div>
</section>
	<!-- footer -->
  <footer>
  <div class="container">
    <div class="row" style="margin-top: 40px;color:#F2F3F9;">
      <div class="col-md-4">
        <h2><b>BakoelBarang.id</b></h2>
        <hr  style="background-color: white;">
        <p><b>Salah satu website penjual barang barang berkualitas,dan
           dapat dipercaya serta memberikan fasilitas yang bagus dan nyaman dalam pengiriman pelanggan.
           </b>
      </p>
      </div>
      <div class="col-md-4">
        <h2><b>Produk Kami</b></h2>
        <hr  style="background-color: white;">
        <ul>
          <li> <a href="kategori.php?id=<?php echo $tiap[0]['id_kategori'] ?>" style="color:white;"><b>Alat Elektronik</b></a></li>
          <li><a href="kategori.php?id=<?php echo $tiap[2]['id_kategori'] ?>" style="color:white;"><b>Fashion</b></a></li>
          <li><a href="kategori.php?id=<?php echo $tiap[1]['id_kategori'] ?>" style="color:white;"><b>Makanan & Minuman</b></a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h2><b>Sosial Media Kami</b></h2>
        <hr  style="background-color: white;">
        <div class="row">
          <div class="col-md-2">
          <h1><i class="fab fa-whatsapp-square"></i></h1>
          </div>
          <div class="col-md-2">
          <h1><i class="fab fa-instagram-square"></i></h1>
          </div>
           <div class="col-md-2">
          <h1><i class="fab fa-facebook-square"></i></h1>
          </div>
            <div class="col-md-2">
          <h1><i class="fas fa-link "></i></h1>
          </div>
        </div>
      </div>
    </div>
    <hr style="background-color: white;">


  </div>
	</footer>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
