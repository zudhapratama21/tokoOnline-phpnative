<?php session_start();?>
<?php 

	include 'koneksi.php';
 ?>
 <?php 
 	//mendapatkan url produk
 	$id_produk=$_GET['id'];
 	$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk' ");
 	$detail=$ambil->fetch_assoc();
  ?>
  <?php 
  	$tiap=array();
  $ambil=$koneksi->query("SELECT * FROM kategori ");
  while ($data=$ambil->fetch_assoc()) {
    $tiap[]=$data;
  }
   ?>
 <!DOCTYPE html>
 <html>
 <head>
 	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="page1.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">
    <title>Bakoelbarang.id</title>
    <style >
 	hr{
 		background-color: black;
 	}
 	.box1{
 		border:4px solid #564F4F;

 	}
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
 </head>
 

 <body>
 	<nav class="navbar navbar-expand-lg navbar-light" style="background-color :#35C8B4;">
  <a class="navbar-brand" href="index.php" style="color:white;">BakoelBarang.id</a>
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

<section class="konten" style="margin-top: 30px">
	<div class="container">

		<strong><h1 style="color:#04B79E;"><i class="fas fa-file"></i> Detail Produk</h1></strong>
		<hr style="background-color: black;"><br><br>
		<div class="row">

			<div class="col-md-6">
				
				<img style="width:300px;height: 300px;padding-right:6px;margin-left: 50px" src="foto_produk/<?php echo $detail["foto_produk"];	?>" class="box1 img-fluid img-thumbnail">
			</div>
			<div class="col-md-6">
				
				<h2 style="color:#04B79E "><i class="fas fa-cube"></i> <b><?php echo $detail['nama_produk']?></b></h2>
				<hr>
				<h5><i class="fas fa-tags"></i> Harga produk :Rp.<?php echo number_format($detail['harga_produk']); ?></h4>
				<hr>
				<h5><i class="fas fa-weight-hanging"></i> Berat (gr) : <?php echo $detail['berat_produk']; ?></h4>
				<hr>
				<h5><i class="fas fa-cubes"></i> Stok :<?php echo $detail['stok_produk']; ?> pcs</h4>
				<hr>
				<form>
				<div class="form-group">
					<label><h5><i class="fas fa-address-book"></i> Deskripsi</h5></label> 
					<p><?php echo $detail['deskripsi_produk'] ?></p>
				</div>
				</form>
				<hr>

				<form method="POST">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" name="jumlah" class="form-control" max="<?php echo $detail['stok_produk'] ?>" placeholder="masukan jumlah	" >
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli" > Beli</button>

							</div>
						</div>

					</div>
				</form>
				<?php
					//jika ada tombol beli
				 if (isset($_POST["beli"])){
				 	//mendapatkan nilai jumlah
				 	$jumlah=$_POST["jumlah"];
				 	//masukan dikeranjang belanja
				 	$_SESSION["keranjang"][$id_produk]=$jumlah;
				 	echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
				 	echo "<script>location='keranjang.php';</script>";
				 }
				 ?>
				
			</div>
		</div>
	</div>
</section>
<!-- komentar -->
<!-- tampilan komentar produk -->
<section>
    <div class="container">
      <p>
        <a class="btn btn-success"  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
         <i class="far fa-arrow-alt-circle-down"></i> Tampilkan komentar
        </a>
        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <i class="far fa-arrow-alt-circle-up"></i> sembunyikan komentar
        </button>
      </p>
     
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <hr>
        <?php 
          $ambil=$koneksi->query("SELECT * FROM komentar_produk LEFT JOIN pelanggan ON komentar_produk.id_pelanggan = pelanggan.id_pelanggan WHERE komentar_produk.id_produk='$id_produk' ORDER BY komentar_produk.id_komentar DESC "); ?>
          <?php while ($perproduk=$ambil->fetch_assoc()){?>
            <p><i class="fas fa-user"></i> <b><?php echo $perproduk['nama_pelanggan']; ?></b></p>
            <p><?php echo $perproduk['konteks']; ?></p> <hr style="margin-top: -10px;">
        
       <?php } ?>
        </div>
      </div>
  
    </div>
  </section>
<!-- mengisi komentar -->

	<section>
		<div class="container" style="margin-bottom: 350px;">
	   <div class="row">
		<div class="col-md-6">
			<form  method="POST">
				<div class="form-group">
					<label><b>Masukan komentar anda !!</b></label> 
					<textarea class="form-control" name="komen" rows="5"></textarea>
				</div>
				<button class="btn btn-primary" style="border-radius: 17px;" name="kirim"><i class="fas fa-upload"></i> Kirim</button>
			</form>
		</div>
		</div>
		</section>
	<?php 
		if (isset($_POST["kirim"])) {
      if (!isset($_SESSION['pelanggan']) )  {

          echo "<script>alert('Anda harus Login');</script>";
          echo "<script>location='login.php';</script>";
        exit();}
			$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
			$komen=$_POST['komen'];
			$koneksi->query("INSERT INTO komentar_produk(id_produk,id_pelanggan,konteks) VALUES ('$id_produk','$id_pelanggan','$komen') ");

      

			echo "<script>alert('printf($id_pelanggan)');</script>";
	   echo "<script>location='detail.php?id=' . $id_produk</script>";  	 	
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