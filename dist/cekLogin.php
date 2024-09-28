<?php

include ("inc_koneksi.php");

if(isset($_POST['btn-login'])){
   if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email      =$_POST['email'];
    $password   =$_POST['password'] ;
    // $password=password_hash($_POST['password'],PASSWORD_BCRYPT) ;

    // Query untuk memeriksa kecocokan email dan password
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
  
    if(mysqli_num_rows($result) == 1){
        $data = mysqli_fetch_assoc($result);
        $hashedpasword = $data['password'];
        // Memverifikasi password yang diinputkan dengan password terenkripsi dari database
        if(password_verify($password,$hashedpasword)){
            if($data['is_verified']==1){
                session_start();
                $_SESSION['email'] = $email;
                header('location:index.php');
                // echo "
                //     <script>
                //         alert('Login Berhasil !');
                //     </script>";
          
            } else {
                //verifikasi
                header('location:login.php?pesan=Silahkan Verifikasi Akun Anda!');
            }
        } else {
            //password salah
        header('location:login.php?pesan=Password Salah!');
        }
    } else {
        //email salah
      header('location:login.php?pesan=Email tidak terdaftar!');

    }
   }
}
?>

<!-- 
$query  =mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $data   =mysqli_fetch_assoc($query);

    if(mysqli_num_rows($query)>=1){
        if($data['is_verified'] == 1){
            session_start();
            $_SESSION['email'] = $email;
            echo "
            <script>
            alert('Login Berhasil !');
          </script>
        ";
        header('location:index.php');
        }else{
            //verifikasi
            header('location:login.php?pesan=Silahkan Verifikasi Akun Anda!');
        }
    
    }else{
        //email salah
        header('location:login.php?pesan=Email atau Password Salah!');
    } -->
