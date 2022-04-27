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
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">
    <title>BakoelBarang.id</title>

    <style>
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
      .size{
        height:350px;
        background-image: url("background.jpg");
        background-size: cover;
      }
        .loc{
          margin-top: 50px;
          margin-left: 50px;
          font-family: Sitka Text;
          font-size: 80px;}
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
        .box{
          border:3px solid #ECECEC;
          box-shadow: 0 3px 10px rgba(0,0,0,0.5);
          border-radius:17px;
          padding: 10px 10px 10px 10px;
          background-color: white;
        }
        .bg{
          background-attachment:fixed;  
          background-image: url("img.png"); 
          background-repeat: no-repeat;
          background-size: cover;
          
        }


    </style>
  </head>
  <body>
    <!-- navbar -->
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
<!-- jumbotron -->
<div class="jumbotron size">
      <div class="loc">
      <h1 style="color:white;"> BakoelBarang.id</h1>  
      <h4>Memiliki persediaan <br> barang yang <br> lengkap  </h4>
      </div>

</div>

<!-- penunjuk -->
<section>
  <div class="container" >
      <div class="row">

        <div class="col-md-4">
          <div class="box">
          <div class="row" >
            
              <div class="col-md-2" style="font-size:50px;color: #60DE0E"><i class="fas fa-hand-holding-usd"></i></div>
              <div class="col-md-8" style="margin-bottom: 4px;margin-left: 20px;margin-left: 20px;margin-top: 20px;"><b>Harga murah dan economis</b></div>
            </div>
            
          </div>
        </div>
        <div class="col-md-4">
          <div class="box"> 
          <div class="row">
            
              <div class="col-md-2" style="font-size:50px;color: #60DE0E"><i class="fas fa-truck-moving"></i> </div>
              <div class="col-md-8" style="margin-bottom: 4px;margin-left: 20px;margin-left: 20px;margin-top: 20px;"><b>Pengiriman yang cepat dan murah</b></div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="box">
          <div class="row">
            
              <div class="col-md-2" style="font-size:50px;color: #60DE0E" ><i class="fas fa-medal"></i></div>
              <div class="col-md-8" style="margin-bottom: 4px;margin-left: 20px;margin-left: 20px;margin-top: 20px;"><b>Barang dijamin bagus dan terpercaya</b></div>
            </div>
          </div>
        </div>
      </div>
  </div>
</section>
    <h1 style="margin-left:100px;margin-top:50px;color:#04B79E;"><i class="fas fa-cubes"></i> Produk Terbaru</h1>
    <hr>
  

    <!-- product -->
  <section  class="konten">
    <div class="container" style="width:75%;">
      <h2 style="color:#0233D2 "><i class="fas fa-laptop-code"></i><b> Alat Elektronik</b></h2>
      <hr>
         <div class="row">

          <?php  $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori=1 ORDER BY id_produk DESC LIMIT 4")?>
          <?php while($perproduk=$ambil->fetch_assoc()) {?>
            <div class="col-md-3" style="margin-top: 20px;">
               <div class="card animation">
                 <img  src="foto_produk/<?php echo $perproduk['foto_produk'] ?>" class="card-img-top img" alt="...">
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

        <br>
        <h2 style="color:#0233D2" ><i class="fas fa-tshirt"></i><b>Fashion</b> </h2>
        <hr>
        <div class="row">
          <?php  $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori=3 ORDER BY id_produk DESC LIMIT 4")?>
          <?php while($perproduk=$ambil->fetch_assoc()) {?>
            <div class="col-md-3" style="margin-top: 20px;">
               <div class="card animation">
                 <img  src="foto_produk/<?php echo $perproduk['foto_produk'] ?>" class="card-img-top img" alt="...">
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
        <br>
        <h2 style="color:#0233D2"><i class="fas fa-utensils"></i> <b>Makanan & Minuman</b></h2>
        <hr>
        <div class="row">
          <?php  $ambil=$koneksi->query("SELECT * FROM produk WHERE id_kategori=2 ORDER BY id_produk DESC LIMIT 4")?>
          <?php while($perproduk=$ambil->fetch_assoc()) {?>
            <div class="col-md-3" style="margin-top: 20px;">
               <div class="card animation">
                 <img src="../foto_produk/<?php echo $perproduk['foto_produk'] ?>" class="card-img-top img" alt="...">
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
        </div>   
  </section>

<!-- categories -->
<!-- informasi -->
<div class="jumbotron bg" >
  <h4 style="margin-left: 50px;margin-bottom: 20px;color: white;font-family: sans-serif;"><b>Berbelanja dengan lebih mudah dan harga tetap economis</b></h4>
  <div class="container" style="margin-left:180px ">
  <div class="row" >
    <div class="col-md-2 box" style="margin-right:20px" >
      <div align="center">
          <p><b>BakoelBarang.id <br> Alat Elektronik </b></p>
          <p>Menjual segala jenis alat elektronik mulai dari laptop , tv , dan lainya</p>
          <a  href="kategori.php?id=<?php echo $tiap[0]['id_kategori'] ?>" style="color:#04B79E;"><b>Mulai berbelanja</b></a>
      </div>
    </div>
    <div class="col-md-2 box" >
      <div align="center">
          <p ><b>BakoelBarang.id <br>  Fashion</b></p>
          <p>Menjual berbagai jenis pakaian yang nyaman untuk dipakai sehari-hari</p>
          <a href="kategori.php?id=<?php echo $tiap[2]['id_kategori'] ?>" style="color:#04B79E;"><b>Mulai Berbelanja</b></a>
      </div>
    </div>
  </div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-2 box" style="margin-top: 30px">
       <div align="center">
          <p><b>BakoelBarang.id <br> Makanan dan Minuman</b></p>
          <p>Menjual serba-serbi makanan yang cocok dipakai oleh-oleh , dan tentunya rasanya nikmat</p>
          <a href="kategori.php?id=<?php echo $tiap[1]['id_kategori'] ?>" style="color:#04B79E;"><b>Mulai Berbelanja</b></a>
       </div>
    </div>
  </div>
</div>
<!-- CONTACK -->

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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
 