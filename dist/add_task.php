<?php
session_start();

include 'inc_koneksi.php';

if (!isset($_SESSION['email'])) {
    header("location: login.php");
  }

// Tambah tugas baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskTitle = $_POST['taskTitle'];
    $taskDesc = $_POST['taskDesc'];
    $email = $_SESSION['email'];
  
    // Query untuk menambahkan tugas baru ke database
    $insertQuery = "INSERT INTO tb_todos (taskTitle, taskDesc, taskStatus, email) VALUES ('$taskTitle', '$taskDesc', 0, '$email')";
    mysqli_query($koneksi, $insertQuery);
  
    // Refresh halaman setelah menambahkan tugas
    header("location: index.php");
  }


?>