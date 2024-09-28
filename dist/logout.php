<?php  
session_start();
session_unset();
//hapus sesi atau token login
session_destroy();

header('location:login.php');
