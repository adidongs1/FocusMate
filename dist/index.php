<!doctype html>


<!-- janlupa section ini di copypasteyaa -->

<?php


session_start();
if(!isset($_SESSION['email'])){
    header('location:login.php');
    exit();
}


include 'inc_koneksi.php';
?>

<<!-- sampe sini -->




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
    <link rel="stylesheet" href="../stylee.css">

    <title>FocusMate</title>
  </head>
  <body>
    <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container">
            <a class="navbar-brand fw-bold navbrand-size" href="#">FOCUSMATE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-uppercase">
                <li class="nav-item">
                  <a class="nav-link active navitem-size" aria-current="page" href="logout.php">LOGOUT</a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link navitem-size" href="#">REPORT</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link navitem-size" href="#">SETTING</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    <!-- Akhir navbar -->

    <!-- section timer -->
        <div class="timer-pomo py-4">
       
          <div class="container timers">
            <div id="sessionLabel" class="text-center mb-4">
              <button id="pomodoroButton" class="btn me-4 btn-label  active" onclick="setSession('work')">Pomodoro</button>
              <button id="shortBreakButton" class="btn me-4 btn-label" onclick="setSession('shortBreak')">Short Break</button>
              <button id="longBreakButton" class="btn me-4 btn-label" onclick="setSession('longBreak')">Long Break</button>
          </div>
            <div class="card card-timer">
              <div id="timer" class="text-center pt-4 pb-3">25:00</div>
              <div class="text-center">
                  <button id="startButton" class="btn btn-start px-4" onclick="startTimer()">START</button>
                  <button id="skipButton" class="btn btn-skip d-none" onclick="skipSession()">Skip</button>
              </div>
          </div>
      </div>
        </div>
          
        </div>
    
    <!-- akhir timer -->
    




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!--  js -->
    <script src="../scriptjs.js"></script>
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