<?php
include 'inc_koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['btn-reset'])) {
  $email = $_POST['email'];

  // Periksa apakah email ada di database
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) == 1) {
    $data = mysqli_fetch_assoc($result);
    $user_id = $data['id_user'];

    // Generate tautan unik untuk mereset password
    $reset_token = generateResetToken();

    // Simpan token reset password ke dalam database
    $query = "UPDATE users SET reset_token = '$reset_token' WHERE id_user = '$user_id'";
    mysqli_query($koneksi, $query);

    // Kirim email reset password
    $reset_link = "http://localhost/FocusMate/dist/reset_password.php?token=$reset_token";
    $email_subject = "Reset Your Password";
    $email_body = "Click the link below to reset your password:\n\n$reset_link";

    $mail = new PHPMailer(true);

    try {
      // Konfigurasi SMTP
      $mail->SMTPDebug = SMTP::DEBUG_OFF;  
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'jadiduitxx@gmail.com';                     //SMTP username
      $mail->Password   = 'wzbreotzlbqustve';       //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      // Set pengirim dan penerima
      $mail->setFrom('no-reply@focusmate.com', 'Reset Password');
      $mail->addAddress($email);

      // Set konten email
      $mail->isHTML(true);
      $mail->Subject = $email_subject;
      $mail->Body    = $email_body;

      $mail->send();
      header("location: login.php?msg=Email sent with password reset instructions");
    } catch (Exception $e) {
      header("location: forgot_password.php?pesan=Failed to send email");
    }
  } else {
    header("location: forgot_password.php?pesan=Email not found");
  }
}

// Fungsi untuk menghasilkan token reset password secara acak
function generateResetToken()
{
  $length = 40;
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $token = '';
  for ($i = 0; $i < $length; $i++) {
    $token .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $token;
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/reset_style.css">

</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container justify-content-center">
            <a class="navbar-brand fw-bold navbrand-size " href="../index.html">FOCUSMATE</a>
          </div>
        </nav>
    <!-- Akhir navbar -->


  <div class="container reset-form">
     <!-- Form untuk memasukkan password baru -->
    <form action="process_reset_password.php" method="post">
      <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
      <div class="mb-2 fw-bold">
        <label for="password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="password" placeholder="New Password" name="password" required>
      </div>
      <div class="d-grid mt-5 ">
        <button type="submit" name="btn-reset" class="btn fw-bold btn-reset">Submit</button>
      </div>
    </form>
  </div>
</body>
</html>

