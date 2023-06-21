<!doctype html>


<?php
include("inc_koneksi.php");

session_start();
if(!isset($_SESSION['email'])){
    header('location:index.php');
    exit();
}


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
            <a class="navbar-brand fw-bold navbrand-size " href="#">FOCUSMATE</a>
          </div>
        </nav>
    <!-- Akhir navbar -->



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

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn text-muted btn-gmail"><img src="../assets/google-logo-icon-png.png" class="logo-gmail">Login with Google</button>
                    </div>

                    <div class="barrier-form my-4">
                        <div class="line-container">
                            <hr class="line">
                            <span class="line-text text-muted">or</span>
                          </div>
                    </div>

                    <div class="card-text">
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
                                    <a href="#">Forgot Password?</a>
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

<!-- SECTION TIMER -->
    <!-- <div class="timer_pomo">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="p-2">
                <ul class="nav nav-tabs justify-content-center tabs">
                  <li class="nav-item"><a class="nav-link active" href="#POMODORO" data-bs-toggle="tab">POMODORO</a></li>
                  <li class="nav-item"><a class="nav-link" href="#SHORTB"  data-bs-toggle="tab">SHORT BREAK</a></li>
                  <li class="nav-item"><a class="nav-link" href="#LONGB"  data-bs-toggle="tab">LONG BREAK</a></li>
                </ul>
                <div class="tab-content">
                  <div id="POMODORO" class="active tab-pane fade in show">
                    
                    <div class="container text-center timers">

                      <h1 class="text-center">Pomodoro Timer</h1>
                      <h2 id="timer">25:00</h2>
                      <button id="startButton" class="btn btn-primary">Start</button>
                      <button id="skipButton" class="btn btn-secondary d-none">Skip</button>

                      <h2 id="sessionLabel">Pomodoro Session</h2>
                      <p id="counter">Pomodoro Count: 0</p>
                      <button id="resetCounterButton" class="btn btn-secondary">Reset Counter</button>
                    </div>


                  </div>
                  <div id="SHORTB" class="tab-pane fade">
                   

                    <div class="container text-center timers">

                      <h1 class="text-center">Short Break Timer</h1>
                      <h2 id="timer">05:00</h2>
                      <button id="startButton" class="btn btn-primary">Start</button>
                      <button id="skipButton" class="btn btn-secondary d-none">Skip</button>

                      <h2 id="sessionLabel">Short Break Session</h2>
                      <p id="counter">Pomodoro Count: 0</p>
                      <button id="resetCounterButton" class="btn btn-secondary">Reset Counter</button>
                    </div>


                  </div>
                  <div id="LONGB" class="tab-pane fade ">
                    

                    <div class="container text-center timers">

                      <h1 class="text-center">Long Break Timer</h1>
                      <h2 id="timer">15:00</h2>
                      <button id="startButton" class="btn btn-primary">Start</button>
                      <button id="skipButton" class="btn btn-secondary d-none">Skip</button>

                      <h2 id="sessionLabel">Long Break Session</h2>
                      <p id="counter">Pomodoro Count: 0</p>
                      <button id="resetCounterButton" class="btn btn-secondary">Reset Counter</button>
                    </div>


                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div> -->