<?php 
	session_start();
	include 'koneksi.php';
?>
<?php  
//jika belum login maka harus login dulu
      
      $idpem = $_GET['id'];
      $ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pembelian ='$idpem'");
      $detpem=$ambil->fetch_assoc();
      //mendapatkan id pelanggan yang beli
      $id_pelanggan_beli=$detpem["id_pelanggan"];
     // mendapatkan id pelanggan yang login
      $id_pelanggan_login=$_SESSION["pelanggan"]["id_pelanggan"];
     if ($id_pelanggan_login!=$id_pelanggan_beli) {
    	  echo "<script>alert('jangan nakal')</script>";
        echo "<script>location='index.php'</script>";
     }
  ?> 
 <!DOCTYPE html>
 <html>
 <head>
 	<title>BakoelBarang.id</title>
 	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
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
          <a class="dropdown-item" href="alatelektronik.php">elektronik</a>
          <a class="dropdown-item" href="fashion.php">Fashion</a>
         <a class="dropdown-item" href="food.php">makanan & minuman</a>
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

<div class="container" style="margin-top: 15px;margin-bottom: 350px;">
	<h2  style="color:#04B79E"><i class="fas fa-user-tag"></i> Konfirmasi Pembayaran</h2>
  <hr>
	<p>Kirim bukti pembayaran anda disini</p>
	<div class="alert alert-info"> Total tagihan anda adalah Rp <strong><?php echo number_format($detpem["total_pembelian"]); ?></strong></div>

	<form method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label><b>Nama Pelanggan</b></label>
			<input type="text" class="form-control" name="nama">
		</div>
		<div class="form-group">
			<label><b>Nama Bank</b></label>
			<input type="text" class="form-control"  name="bank">
		</div>
		<div class="form-group">
			<label><b>Jumlah Pembayaran</b></label>
			<input type="number" class="form-control" name="jumlah" min="1">
		</div>
		<div class="form-group">
			<label><b>Foto bukti</b></label>
			<input type="file" class="form-control" name="bukti"> 
			<p class="text-danger">foto bukti harus format JPG dan maksimal 1MB </p>
		</div>
		<button class="btn btn-success" style="border-radius: 15px;" name="kirim"><i class="fas fa-upload"></i> Kirim</button>
	</form>	
<?php 
  //jika ada tombol kirim
if (isset($_POST["kirim"])) {
  //upload foto kirim

  $namabukti=$_FILES["bukti"]["name"];
  $lokasibukti=$_FILES["bukti"]["tmp_name"];
  $namafix=date("YmdHis").$namabukti;

  move_uploaded_file($lokasibukti,"bukti pembayaran/$namafix");

  $nama=$_POST["nama"];
  $bank=$_POST["bank"];
  $jumlah=$_POST["jumlah"];
  $tanggal=date("Y-m-d");

  //simpan pembayaran
  $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namafix')");

  $koneksi->query("UPDATE pembelian SET status_pembelian ='sudah kirim pembayaran' WHERE id_pembelian='$idpem'");
  echo "<script>alert('terima kasih sudah mengirim bukti pembayaran');</script>";
  echo "<script>location='index.php'</script>";
}
 ?>
</div>
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

 </body>
 </html>
 