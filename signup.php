  <?php 
    include'koneksi.php';
 ?>
<!Doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.min.css">
    <title>website</title>
  </head>
  <body style="background-color:#157057;">
  
        <div class="container" style="width:35%;margin-bottom:50px ;padding-left:30px;padding-right:30px;border-radius:20px;">
            <h3 class="text-center" >SIGN UP</h3>
            <hr>
            <form action="" method="POST">
                <div class="form-group">
                    <label><strong>Username</strong></label>
                    <div class="input-group">
                        <div class="input-prepend">
                            <div class="input-group-text"><i class="fas fa-user" style="height: 24px"></i></div>
                        </div> 
                        <input type="text" name="nama" class="form-control" placeholder="masukan username anda " required>
                    </div>

                </div>
                <div class="form-group">
                    <label><strong>Email</strong></label>
                    <div class="input-group">
                        <div class="input-prepend">
                            <div class="input-group-text"><i class="fas fa-user" style="height: 24px"></i></div>
                        </div> 
                        <input type="email" name="email" class="form-control" placeholder="masukan email anda " required>
                    </div>

                </div>

                <div class="form-group">
                    <label > <strong>Password</strong></label>
                    <div class="input-group">
                        <div class="input-prepend">
                            <div class="input-group-text"><i class="fas fa-unlock" style="height: 24px"></i></div>
                        </div> 
                            <input type="password" name="password" class="form-control" placeholder="masukan password anda" required>
                    </div>
                </div>
                <div class="form-group">
                    <label > <strong>Telp/HP</strong></label>
                    <div class="input-group">
                        <div class="input-prepend">
                            <div class="input-group-text"><i class="fas fa-unlock" style="height: 24px"></i></div>
                        </div> 
                            <input type="text" name="telepon" class="form-control" placeholder="masukan telepon anda" required>
                    </div>
                </div>
                 <div class="form-group">
                  <label><strong>Kategori</strong></label>
                  <select class="form-control" name="level" required>
                  <option >pelanggan</option>
                  </select>
                  
                </div>
                 <div class="form-group">
                    <label ><strong>Alamat</strong></label>
                    <div class="input-group">
                        <textarea class="form-control" name="alamat" rows="3" placeholder="masukan alamat anda" required></textarea>   
                    </div>
                </div>
               
                 
                <button name="daftar" class="btn btn-primary" style="border-radius: 15px">Create</button>
                <a href="login.php" class="btn btn-primary" style="border-radius: 15px">Kembali ke login</a>
            </form>
            <?php 
                //jika tekan tombol daftar 
                if (isset($_POST["daftar"])) {
                    //mengambil isian dari db
                   $nama=$_POST['nama']; 
                   $email=$_POST['email'];
                   $password=$_POST['password']; 
                   $alamat=$_POST['alamat']; 
                   $telepon=$_POST['telepon'];
                   $level=$_POST['level']; 
                   //cek apakah email sudah digunakan atau belum
                   $ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                   $yangcocok=$ambil->num_rows;
                   if ($yangcocok==1) {
                        echo "<script>alert('registrasi gagal,akun sudah dipakai');</script>";
                        echo "<script>location='signup.php'</script>";
                       
                   }
                   else{
                        //query insert ke db pelanggan
                    $koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan,level) VALUES ('$email','$password','$nama','$alamat','$telepon','$level')  ");
                    echo "<script>alert('pendaftaran sukses , silahkan login')</script>";
                    echo "<script>location='login.php'</script>";
                   }

                }

             ?>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>