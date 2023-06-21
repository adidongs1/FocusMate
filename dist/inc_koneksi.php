<?php
$db_host    = "localhost";
$db_email   = "root";
$db_pass    = "";
$db_name    = "db_focusmate";

$koneksi    = mysqli_connect($db_host, $db_email, $db_pass, $db_name);

if(!$koneksi){
   die ("koneksi gagal");
}

?>