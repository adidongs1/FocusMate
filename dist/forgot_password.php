<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/style_forgot.css">

</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container justify-content-center">
            <a class="navbar-brand fw-bold navbrand-size " href="../index.html">FOCUSMATE</a>
          </div>
        </nav>
    <!-- Akhir navbar -->
  <div class="container">
    <div class="forgot-form">
            <h2 class="text-center">Forgot Password</h2>
            <p class="text-center">Enter your email address</p>
        <!-- Form untuk memasukkan email -->
        <form action="reset_password.php" method="post">
          <div class="mb-4 fw-bold">
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email" name="email" required>
          </div>
          <div class="d-grid mt-2">
            <button type="submit" name="btn-reset" class="btn fw-bold btn-reset">Continue</button>
          </div>
        </form>
    </div>
  </div>
</body>
</html>