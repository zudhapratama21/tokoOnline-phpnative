<?php 
	session_start();
	include'koneksi.php';
 ?>
 <?php  

 $key=$_GET['keyword'];
 $semuadata=array();
 $ambil=$koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$key%' OR deskripsi_produk LIKE '%$key%'");

while($pecah=$ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}
$tiap=array();
  $ambil=$koneksi->query("SELECT * FROM kategori ");
  while ($data=$ambil->fetch_assoc()) {
    $tiap[]=$data;
  }
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>BakoelBarang.id</title>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="page1.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="../admin/assets/css/bootstrap.css"> -->
    
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">

</head>
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

<section style="margin-top:40px;margin-left:50px" class="konten">
    <div class="container" style="width:75%;">
      <h3 class="alert alert-info">Hasil Pencarian : <b><?php echo $key; ?></b> </h3>
      <?php if (empty($semuadata)): ?>
        <div class="alert alert-danger"> produk <b><?php echo $key ?></b> tidak ditemukan</div>
      <?php endif ?>
         <div class="row">
          <?php foreach ($semuadata as $key => $value): ?>
            <div class="col-md-3" style="margin-top: 20px;">
               <div class="card">
                 <img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" style="width: 200px;height: 200px;padding: 10px 10px 10px 10px;" >
                   <div class="card-body">
                  <h5><?php echo $value["nama_produk"]; ?></h3>
                  <h6><?php echo number_format($value["harga_produk"]) ?></h5>
                   <h6>stok  : <?php echo $value['stok_produk'] ?></h6>
                   <a href="beli.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-primary">Beli</a>
                   <a href="detail.php?id=<?php echo $value['id_produk']; ?>" class="btn btn-danger"> Detail</a>
                  </div>
               </div>
            </div> 
          <?php endforeach ?>
          </div>
        </div>   
  </section>


</body>
</html>