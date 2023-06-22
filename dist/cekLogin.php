<?php

include("inc_koneksi.php");


if(isset($_POST['btn-login'])){
    $email      =$_POST['email'];
    $password   =$_POST['password'];

    $query  =mysqli_query($koneksi, "SELECT * FROM tb_user WHERE email='$email'");
    $data   =mysqli_fetch_array($query);

    if(mysqli_num_rows($query)==1){
        if(password_verify($password, $data['password'])){
            //login valid
            session_start();
            $_SESSION['email'] = $data['email'];
            header('location:index.php');
        }else{
            //pasword salah
            header('location:login.php?pesan=Password Salah');
        }
    
    }else{
        //email salah
        header('location:login.php?pesan=Email Salah');
    }

}
?>