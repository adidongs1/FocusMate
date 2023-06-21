<?php
$db_host    = {{ secrets.db_host }};
$db_email   = {{ secrets.db_user }};
$db_pass    = {{ secrets.db_pass }};
$db_name    = {{ secrets.db_name }};

$koneksi    = mysqli_connect($db_host, $db_email, $db_pass, $db_name);

if(!$koneksi){
   die ("koneksi gagal");
}

?>
