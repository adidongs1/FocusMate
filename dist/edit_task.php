<?php
// Include file koneksi database
include 'inc_koneksi.php';

// Periksa apakah ada parameter taskId yang diterima dari URL
if (isset($_GET['taskId'])) {
  $taskId = $_GET['taskId'];

  // Lakukan logika pengambilan data task dari database berdasarkan taskId
  $query = "SELECT * FROM tb_todos WHERE taskId = '$taskId'";
  $result = mysqli_query($koneksi, $query);

  // Periksa apakah task dengan taskId yang diberikan ada di database
  if (mysqli_num_rows($result) > 0) {
    $task = mysqli_fetch_assoc($result);

    // Periksa apakah form pengeditan task telah dikirimkan
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Ambil data yang diperbarui dari formulir
      $newTaskTitle = $_POST['taskTitle'];
      $newTaskDesc = $_POST['taskDesc'];

      // Lakukan logika pembaruan task ke dalam database
      $updateQuery = "UPDATE tb_todos SET taskTitle = '$newTaskTitle', taskDesc = '$newTaskDesc' WHERE taskId = '$taskId'";
      mysqli_query($koneksi, $updateQuery);

      // Alihkan pengguna ke halaman index.php setelah pembaruan task
      header('location:index.php'); // Ganti dengan halaman yang sesuai
      exit();
    }

    // Contoh tampilan formulir pengeditan task
    ?>
  <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/edit_task_style.css">

</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
          <div class="container justify-content-center">
            <a class="navbar-brand fw-bold navbrand-size " href="../index.html">FOCUSMATE</a>
          </div>
        </nav>
    <!-- Akhir navbar -->


    <div class="container edittask-form">
    <h2 class="text-center">Edit Task</h2>
  
    <form class="edit-form" action="edit_task.php?taskId=<?php echo $taskId; ?>" method="post">
      <div class="mb-4 fw-bold">
          <label for="taskTitle">Task Title:</label>
          <input type="text" class="form-control"  aria-describedby="" placeholder="" name="taskTitle"  value="<?php echo $task['taskTitle']; ?>">
      </div>
      <div class="mb-2 fw-bold">
          <label for="taskDesc" class="form-label">Task Description:</label>
          <input class="form-control"  placeholder="" id="taskDesc" type="text" name="taskDesc" value="<?php echo $task['taskDesc']; ?>">
        </div>
      
      <div class="button-container text-center">
        <button class="btn btn-update" type="submit">Update Task</button>
      </div>
    </form>
  </div>
</body>
</html>
    <?php
  } else {
    // Jika task dengan taskId yang diberikan tidak ditemukan di database, kembalikan pengguna ke halaman sebelumnya atau berikan pesan error
    header('location:index.php'); // Ganti dengan halaman yang sesuai
    exit();
  }
} else {
  // Jika tidak ada parameter taskId yang diterima, kembalikan pengguna ke halaman sebelumnya atau berikan pesan error
  header('location:index.php'); // Ganti dengan halaman yang sesuai
  exit();
}
?>
