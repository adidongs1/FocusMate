<!doctype html>

<?php
    session_start();
    if(isset($_SESSION['email'])){
        header('location:index.php');
        exit();
    }


    include 'inc_koneksi.php';
?>


<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css -->
    <link rel="stylesheet" href="css/login_style.css">

    <title>FocusMate</title>
  </head>
  <body>
    <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container justify-content-center">
            <a class="navbar-brand fw-bold navbrand-size " href="../index.html">FOCUSMATE</a>
          </div>
        </nav>
    <!-- Akhir navbar -->

      <div class="global-container">
      <?php
              if(isset($_GET['msg'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
               <?php echo $_GET['msg']; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php } ?>
      </div>

    <!-- Section login -->
        <div class="global-container">
          <div class="row justify-content-center">
            <div class="col">

            <?php
              if(isset($_GET['pesan'])) {
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Login Gagal!</strong> <?php echo $_GET['pesan']; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php } ?>



            <div class="card login-form">
                <div class="card-body">
                    <h1 class="card-title mb-4">Login</h1>

                    <div class="card-text">
  <!-- FORM DISINI -->
                        <form action="cekLogin.php" method="post">
                            <div class="mb-4 fw-bold">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@mail.com" name="email" >
                            </div>
                            <div class="mb-2 fw-bold">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control" id="password"placeholder="your password" name="password">
                            </div>

                          <div class="d-flex rem-pass">

                                <div class="forgot-pass">
                                    <a href="forgot_password.php">Forgot Password?</a>
                                </div>
                          </div>


                            <div class="d-grid mt-5 ">
                                <button type="submit" name="btn-login" class="btn fw-bold btn-login">Login</button>
                            </div>

                            <div class="register mt-2">
                                <label>Do not have an account? <a href="register.php">Create an account</a></label>
                            </div>
                          </form>
                    </div>
                </div>
                
            </div>
            </div>
          </div>
          
        </div>

    <!-- alhir login -->




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--  js -->
    <script src="#"></script>
  </body>
</html>