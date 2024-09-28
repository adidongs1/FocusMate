<?php
include("inc_koneksi.php");

if (isset($_POST['btn-reset'])) {
  $token = $_POST['token'];
  $password = $_POST['password'];

  // Periksa apakah token ada di database
  $query = "SELECT * FROM users WHERE reset_token = '$token'";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
    $user_id = $data['id_user'];

    // Update password baru di database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$hashed_password', reset_token = NULL WHERE id_user = '$user_id'";
    mysqli_query($koneksi, $query);

    header("location: login.php?msg=Password reset successful");
  } else {
    header("location: reset_password.php?token=$token&pesan=Invalid token");
  }
}
?>