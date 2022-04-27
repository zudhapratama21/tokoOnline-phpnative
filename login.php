<?php 
  session_start();
    //koneksi ke database
  include 'koneksi.php';
  require 'vendor/autoload.php';
// login dengan google
//Step 1: Enter you google account credentials
$g_client = new Google_Client();
$g_client->setClientId("902654285398-d7mkrj1t27pn15u4r9k7erl84lhbp86u.apps.googleusercontent.com");
$g_client->setClientSecret("dqzOpgd1A_o1S5067Cvx19LG");
$g_client->setRedirectUri("http://localhost/website/login.php");
$g_client->setScopes("profile");
$g_client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);

//Step 2 : Create the url
$auth_url = $g_client->createAuthUrl();

//Step 3 : Get the authorization  code
$code = isset($_GET['code']) ? $_GET['code'] : NULL;

//Step 4: Get access token
if(isset($code)) {

    $token = $g_client->fetchAccessTokenWithAuthCode($code);
    $g_client->setAccessToken($token['access_token']);

    // get profile information
    $google_oauth = new Google_Service_Oauth2($g_client); 
    $google_account_info = $google_oauth->userinfo->get();
    $data = $google_account_info;
} 
else{
    $data = null;
}




// hasil data tekan google
// jika berhasil mendapatkan data dari google login
if(isset($data)){

    $email = $data["email"];

    // ambil data user
    $result = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email_pelanggan = '$email'");

    // cek apakah email sudah terdaftar
    if(mysqli_num_rows($result) == 1){

        // menjalankan session
        $_SESSION["pelanggan"] = $data;

        //pindah halaman
        header("Location: index.php");
        exit;

    }
    if (!mysqli_num_rows($result))
    { // kalau belum terdaftar, maka kita daftarkan

        $nama = $data["givenName"];
        $email = $data["email"];
        $password = $data["id"];

        // masukkan data ke database
        $test = mysqli_query($koneksi, "INSERT INTO pelanggan VALUES('', '$email', '$password', '$nama', '', '', 'pelanggan')");

        
        // menjalankan session
        $_SESSION["pelanggan"] = $data;

        //pindah halaman
        echo "<script>alert('Untuk Login Berikutnya Anda bisa meminta password pada admin dengan menekan FAQ');</script>";
        echo "<script>location='index.php';</script>";
        //header("Location: index.php");
        exit;

    }

    else {
    //anda gagal login
    echo "<script>alert('anda gagal login, periksa kembali akun anda');</script>";
    echo "<script>location='login.php';</script>";
  }

}


 ?>
<!doctype html>
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
  
        <div class="container" style="width: 30%;padding-left:30px;padding-right:30px;border-radius: 20px;">
            <h3 class="text-center" ><b>LOGIN</b></h3>
            <hr>
            <p align="center"><b>login with social account</b></p>
            <a href="<?= $auth_url ?>" > <i class="fab fa-google-plus" style="font-size:30px;color:#B40E25;margin-left: 116px"></i></a>
            <a href="" > <i class="fab fa-facebook" style="font-size:30px;color:#B40E25;margin-left: 10px;margin-right: 10px;"></i></a>
            <a href="" > <i class="fab fa-linkedin-in" style="font-size:30px;color:#B40E25"></i></a>
            <p align="center">______</p>
            <p align="center">or with your account</p>
            <form action="" method="POST">
                <div class="form-group">
                    <label > <strong>Email</strong></label>
                    <div class="input-group">
                        <div class="input-prepend">
                            <div class="input-group-text"><i class="fas fa-user" style="height: 24px"></i></div>
                        </div> 
                        <input type="text" name="email" class="form-control" placeholder="masukan email anda">
                        
                    </div>
                
                </div>

                <div class="form-group">
                    <label ><strong>Password</strong></label>
                    <div class="input-group">
                        <div class="input-prepend">
                            <div class="input-group-text"><i class="fas fa-unlock" style="height: 24px"></i></div>
                        </div> 
                            <input type="password" name="password" class="form-control" placeholder="masukan password anda">
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary" style="border-radius: 15px">Submit</button>
               
                
              
            </form>
            <p class="text-center">not a member ? <a href="signup.php">sign up</a></p>


        <?php 
            if (isset($_POST['submit'])) {
                $email=$_POST["email"];
                $password=$_POST["password"];
                $ambil=$koneksi->query("SELECT * FROM user WHERE email='$email' AND password_pelanggan='$password'");

                $akunyangcocok=$ambil->num_rows;
                if ($akunyangcocok==1) {
                     $akun=$ambil->fetch_assoc();
                       if ($akun['level']=='admin') {
                        $_SESSION['admin']=$akun;
                           echo "<div class='alert alert-info'>Login Sukses</div>";
                           echo "<meta http-equiv='refresh' content=1;url='admin/index.php'>";
                       }elseif($akun['level']=='pelanggan'){
                        $_SESSION['pelanggan']=$akun;
                         echo "<div class='alert alert-info'></div>";
                         echo "<meta http-equiv='refresh' content=1;url='index.php'>";}
                }else{

                      echo "<div class='alert alert-danger'>Login Gagal , registrasi dulu ya</div>";
                      echo "<meta http-equiv='refresh' content=1;url='.php'>";
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
