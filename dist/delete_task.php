<?php
// Include file koneksi database
include 'inc_koneksi.php';
// Periksa apakah ada parameter taskId yang diterima dari URL
if (isset($_GET['taskId'])) {
  $taskId = $_GET['taskId'];

  // Lakukan logika penghapusan task dari database berdasarkan taskId
  $deleteQuery = "DELETE FROM tb_todos WHERE taskId = '$taskId'";
  mysqli_query($koneksi, $deleteQuery);

  // Alihkan pengguna ke halaman index.php setelah penghapusan task
  header('location:index.php'); // Ganti dengan halaman yang sesuai
  exit();
} else {
  // Jika tidak ada parameter taskId yang diterima, kembalikan pengguna ke halaman sebelumnya atau berikan pesan error
  header('location:index.php'); // Ganti dengan halaman yang sesuai
  exit();
}
?>
