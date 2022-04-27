<?php 
  session_start();
    //koneksi ke database
    //jika tidak ada session pelanggan maka lari di sesi login

  include 'koneksi.php';

    $tiap=array();
  $ambil=$koneksi->query("SELECT * FROM kategori ");
  while ($data=$ambil->fetch_assoc()) {
    $tiap[]=$data;
  }

 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="page1.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">
    <title>BakoelBarang.id</title>

    <style>
    
      .animation{
          box-shadow: 0 3px 10px rgba(0,0,0,0.5);
          border-radius: 25px;
        }
        .img{
          width: 200px;
          height: 200px ; 
          padding: 10px 10px 10px 10px;
          transition-duration: 0.3s;
        }
        .img:hover{
          width: 220px;
          height: 220px;
        }

        .size{
        height:350px;
        background-image: url("background.jpg");
        background-size: cover;
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
    <!-- navbar -->
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
<!-- jumbotron -->
<div class="jumbotron size">
      <div class="loc">
      <h1 style="color:white;"> BakoelBarang.id</h1>  
      <h4>Memiliki persediaan <br> barang yang <br> lengkap  </h4>
      </div>

</div>

 <section  class="konten">
    <div class="container" style="width:75%;">
     <h2 style="color:#35C8B4"><b><i class="fas fa-search"></i> Produk yang anda inginkan</b></h2>
     <hr>
         <div class="row">
          
          <br>
           <?php  $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'")?>
          <?php while($perproduk=$ambil->fetch_assoc()) {?>
            <div class="col-md-3" style="margin-top: 20px;">
               <div class="card animation">
                 <img src="foto_produk/<?php echo $perproduk['foto_produk'] ?>" class="card-img-top img" alt="...">
                   <div class="card-body">
                   <h6> <b><?php echo $perproduk['nama_produk'] ?></b></h6>
                   <h6><i class="fas fa-tags"></i> Rp.<?php echo number_format($perproduk['harga_produk']);  ?></h6>
                   <h6><i class="fas fa-cube"></i> Stok  : <?php echo $perproduk['stok_produk'] ?></h6>
                   <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary"><i class="fas fa-shopping-basket"></i> Beli</a>
                   <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-danger"> <i class="fas fa-file"></i> Detail</a>
                  </div>
               </div>
            </div> 
          <?php } ?>
          </div>
          <hr>
        </div> 

  </section>
  <section >
  <div class="container" style="margin-bottom: 380px;margin-top: 100px;">
    <div class="col-md-6" style="border:3px solid #ECECEC;border-radius:17px;height: 180px;box-shadow: 0 3px 10px rgba(0,0,0,0.5);background-color: #4FF1C5">
      <h2 style="padding-top: 50px;">Apakah anda memiliki kendala ?</h2>
      <a href="https://api.whatsapp.com/send?phone=625896405623" class="btn btn-primary" style="border-radius: 15px;margin-top: 20px;">Hubungi Kami</a>
    </div>
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
  </body>
</html>