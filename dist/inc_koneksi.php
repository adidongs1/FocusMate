<?php

$db_host    = "localhost";
$db_user   = "id20918960_adminganteng";
$db_pass    = "4dmin-g@ntenG";
$db_name    = "id20918960_db_focusmate";

$koneksi    = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(!$koneksi){
   die ("koneksi gagal");
}

?>
