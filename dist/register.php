<!doctype html>
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
    <link rel="stylesheet" href="css/register.css">

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



    <!-- Section login -->
        <div class="global-container">
          <div class="row justify-content-center">
            <div class="col">
            <div class="card login-form">
                <div class="card-body">
                    <h1 class="card-title mb-4">Register</h1>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn text-muted btn-gmail"><img src="../assets/google-logo-icon-png.png" class="logo-gmail">Sign up with Google</button>
                    </div>

                    <div class="barrier-form my-4">
                        <div class="line-container">
                            <hr class="line">
                            <span class="line-text text-muted">or</span>
                          </div>
                    </div>

                    <div class="card-text">
                        <form action="" method="post">
                            <div class="mb-4 fw-bold">
                              <label for="email" class="form-label">Email</label>
                              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="example@mail.com" name="email" required >
                            </div>
                            <div class="mb-2 fw-bold">
                              <label for="password" class="form-label">Password</label>
                              <input type="password" class="form-control" id="password"placeholder="your password" name="password" required>
                            </div>

                  


                            <div class="d-grid mt-5 ">
                                <button type="submit" name="btn-register" class="btn fw-bold btnRegis">Sign up with Email</button>
                            </div>

                            <div class="register mt-2">
                                <label>Already have an account? <a href="login.php">Log in</a></label>
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

<?php

include 'inc_koneksi.php';
if(isset($_POST['btn-register'])){
  $email=$_POST['email'];
  $password=password_hash($_POST['password'],PASSWORD_BCRYPT) ;

  $query=mysqli_query($koneksi, "INSERT INTO tb_user VALUES('$email','$password')");

  if($query){
    echo"
          <script>
          alert('Sign up success! You can now log in with your email and password.');
          window.location.href='login.php'
        </script>
    ";
  }else{
    echo"
    <script>
    alert('Sign up Failed! Please use another email.');
  </script>
";
  }
}

?>

