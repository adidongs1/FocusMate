<!-- janlupa section ini di copypasteyaa -->

<?php

session_start();

include 'inc_koneksi.php';


if (!isset($_SESSION['email'])) {
  header('location:login.php');
  exit();
}

// Ambil tugas-tugas berdasarkan email pengguna yang terautentikasi
$email = $_SESSION['email'];
$query = "SELECT * FROM tb_todos WHERE email = '$email'";
$result = mysqli_query($koneksi, $query);
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!-- sampe sini -->

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


  <!-- font box-icon -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- css -->
  <!-- <link rel="stylesheet" href="css/index_php.css"> -->
  <link rel="stylesheet" href="css/style_php.css">

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
          <li class="nav-item">
            <a class="nav-link navitem-size" href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">SETTING</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Akhir navbar -->


  <!-- SETTING -->
  <div id="id01" class="modal">
    <form class="modal-content">
      <div class="container container-settings">
        <div class="close" title="Close Modal">&times;</div>
        <h1 class="heading">Setting</h1>

        <hr class="my-3">

        <h5 class="align-items-center"><i class="fa-regular fa-clock me-2"></i>Timers <span class="text-muted">(minutes)</span></h5>

        <div class="row g-3">
          <div class="col-md-4">
            <label for="pomodoroInput" class="form-label">Pomodoro</label>
            <input class="form-control" id="pomodoroInput" placeholder="Amount" type="number" name="pomodoro" value="25" min="10" max="99">
          </div>
          <div class="col-md-4">
            <label for="shortBreakInput" class="form-label">Short Break</label>
            <input class="form-control" id="shortBreakInput" placeholder="Amount" type="number" name="short-break" value="5" min="2" max="30">
          </div>
          <div class="col-md-4">
            <label for="longBreakInput" class="form-label">Long Break</label>
            <input class="form-control" id="longBreakInput" placeholder="Amount" type="number" name="long-break" value="15" min="5" max="60">
          </div>
        </div>

        <hr class="my-3">

        <div class="col-12 mt-3">
          <button type="submit" id="saveButton" class="btn btn-saves">Save </button>
        </div>
      </div>




  </div>
  </form>
  </div>




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

  <!-- AKHIR timer -->


  <!-- section TODOLIST -->

  <div class="container todos">
    <div class="header">

      <div class="title">
        Todo List
      </div>
      <div class="sub-title">
        <h6>Welcome, <?php echo $email; ?></h6>
      </div>

    </div>


    <div class="content">
      <div class="card" id="taskForm" style="display: none;">
        <div class="me-auto">
          <button id="closeFormButton" class="btn btn-closeFormTask ms-auto"><i class="fa-solid fa-x"></i></button>
        </div>
        <!-- form todo disini -->
        <form action="add_task.php" method="post">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingInput" placeholder="Task Title" name="taskTitle" required>
            <label for="floatingInput">Task Title</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingText" placeholder="task Desc" name="taskDesc">
            <label for="floatingText">Description</label>
          </div>
          <div>
            <button type="submit" class="btn my-3 btn-taskadding">Add Task</button>
          </div>
        </form>
      </div>

      <!-- ini adalah card item -->
      <?php foreach ($tasks as $task): ?>
        <div class="card">

          <div class="task-lists d-flex align-items-center">

            <div class="task-items">

              <input class="form-check-input" type="checkbox" value="" id="flexCheckTaskItems" data-task-id="<?php echo $task['taskId']; ?>" onchange="toggleTaskDecoration(this)">

              <label class="form-check-label" for="flexCheckDefault">
                <p class="title-todo"><?php echo $task['taskTitle']; ?></p>
                <p class="desc-todo"><?php echo $task['taskDesc']; ?></p>
              </label>

            </div>

            <div class="task-items-nav ms-auto">
              <a href="#" onclick="editTask(<?php echo $task['taskId']; ?>)" name="edit"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="#" onclick="deleteTask(<?php echo $task['taskId']; ?>)"><i class="fa-solid fa-trash"></i></a>
            </div>


          </div>

        </div>
      <?php endforeach; ?>

      <div class="d-grid">
        <button id="openFormButton" class="btn btn-addTask"><i class="fa-solid fa-plus me-2"></i>Add Task</button>
      </div>
    </div>
  </div>




  <!-- akhir todo list -->



  <!-- pomodoro desc -->
  <section id="pomodoro-section" class="mt-5">
    <div class="container pomo-desc">

      <h2 class="pomo-desc-title">Apa itu Focusmate?</h2>
      <hr class="garisbawah">

      <p>
        <span class="warna">Focusmate</span> adalah sebuah aplikasi berbasis web yang dirancang untuk membantu pengguna meningkatkan fokus dan produktivitas mereka. Focusmate memanfaatkan konsep akuntabilitas dan dukungan dari sesama pengguna untuk menciptakan lingkungan kerja virtual yang terstruktur.

        Dalam Focusmate, setiap pengguna berkomitmen untuk menjelaskan tugas yang akan mereka kerjakan pada awal sesi. Hal ini membantu mengarahkan fokus dan memastikan pengguna bekerja pada tugas yang dijadwalkan.


      <p>Teknik Pomodoro juga menjadi salah satu motif utama di balik pengembangan <span>Focusmate</span>. Aplikasi ini mengadopsi prinsip-prinsip dasar teknik Pomodoro dan memadukannya dengan fitur-fitur unik yang ditawarkan.
      </p>

      </p> <br> <br>

      <h2 class="pomo-desc-title">Apa itu Teknik Pomodoro?</h2>
      <hr class="garisbawah">
      <p>
        Teknik Pomodoro adalah sebuah metode manajemen waktu yang dikembangkan oleh <span class="warna">Francesco Cirillo</span> pada akhir 1980-an. Metode ini dirancang untuk meningkatkan produktivitas dengan memanfaatkan prinsip fokus dan istirahat secara bergantian.
      </p>
      <p>
        Nama "Pomodoro" berasal dari bahasa Italia yang berarti "tomat". Cirillo memilih nama ini karena menggunakan sebuah timer dapur berbentuk tomat saat ia mengembangkan teknik ini.
        Dalam metode Pomodoro, waktu kerja dibagi menjadi periode fokus yang disebut "pomodoro" yang masing-masing berdurasi sekitar 25 menit. Setiap periode pomodoro diikuti oleh istirahat singkat selama 5 menit. Setelah empat periode pomodoro, dilakukan istirahat yang lebih panjang, sekitar 15-30 menit.
      </p> <br>

      <h2 class="pomo-desc-title">Bagaimana Cara menggunakan Focusmate?</h2>
      <hr class="garisbawah">

      <p class="task"> <br>

        <span class="warna">1. Tambahkan task untuk dikerjakan.</span> <br>Daftarkan atau masukkan daftar tugas yang perlu Anda selesaikan pada hari tersebut. Misalnya, daftar tugas dapat berisi "Menulis laporan proyek", "Membalas email klien", "Persiapan rapat", dll. <br><br>

        <span class="warna">2. Tetapkan perkiraan waktu untuk setiap sesi.</span> <br> Tentukan berapa banyak waktu yang dibutuhkan untuk setiap sesi: <span class="warna">Pomodoro</span>, <span class="warna">Short Break</span>, dan <span class="warna">Long Break</span>. <br><br>

        <span class="warna">3. Mulai timer dan fokus pada tugas selama waktu yang ditentukan.</span> <br> Klik tombol <a href="#" class="btn-start px-4" style="text-decoration: none; color: #000;">START</a> untuk memulai timer. kamu juga bisa menghentikan waktu dengan tombol <a href="#" class="btn-start px-4" style="text-decoration: none; color: #000;">PAUSE</a>, dan melewati setiap sesi dengan tombol <a href="#" class="btn-skip px-4" style="text-decoration: none; color: #000;">SKIP</a>. <br><br>

        <span class="warna">4. Gunakan FOCUSMATE ini sebagai kesempatan untuk meningkatkan produktivitasmu.</span> <br> Saat alarm berbunyi dan timer berhenti, berhenti sejenak dan evaluasi seberapa jauh kamu telah mencapai tujuanmu. <br><br>

        <span class="warna">5.Saat sesi istirahat, berhentilah melakukan pekerjaan apapun.</span> <br> Cobalah untuk benar-benar memisahkan dirimu dari pekerjaan selama sesi istirahat ini. Istirahat sepenuhnya dan nikmati momen ini.<br><br>

        <span class="warna">6. Lakukan iterasi 3-5 kali hingga menyelesaikan tugas-tugas.</span> <br> Setelah istirahat, kembali ke langkah 3 dan jika tugasmu sudah selesai jangan lupa untuk menandai dengan centang pada tugas yang sudah selesai. Ulangi langkah-langkah 4 dan 5 hingga Anda menyelesaikan semua tugas yang telah ditetapkan. <br><br>

      <p>Teknik Pomodoro menggabungkan periode fokus intensif dengan istirahat terjadwal untuk membantu meningkatkan produktivitas dan menjaga stamina mental. Dengan menerapkan metode ini, Anda dapat memecah pekerjaan menjadi potongan-potongan yang lebih kecil, menjaga fokus yang tinggi selama periode kerja, dan memberikan waktu istirahat yang diperlukan untuk menghindari kelelahan dan menjaga </p>




    </div>




  </section>

  <!-- akhir deskripsi -->

  <!-- footer -->

  <footer>
    <div class="row mt-3 col-copyright">
      <div class="col text-center">
        <p class="text-white">&copy;This website is the ANT Vape Store landing page which was created with the aim of completing the final assignment for a digital business course. not selling anything.| Built by <a href="#">Adidongsss and Omoyzzz</a></p>
      </div>
    </div>
  </footer>

  <!-- akhir footer -->


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!--  js -->
  <script src="js/script_php.js"></script>
</body>

</html>