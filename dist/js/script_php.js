var timerInterval;
var minutes = 25;
var seconds = 0;
var isTimerRunning = false;
var sessionType = "work";
var sessionCount = 0;
var sessions = [
  { type: "work", duration: 25 },
  { type: "shortBreak", duration: 5 },
  { type: "work", duration: 25 },
  { type: "shortBreak", duration: 5 },
  { type: "work", duration: 25 },
  { type: "shortBreak", duration: 5 },
  { type: "work", duration: 25 },
  { type: "longBreak", duration: 15 }
];

function startTimer() {
  if (!isTimerRunning) {
    isTimerRunning = true;
    timerInterval = setInterval(updateTimer, 1000);
    document.getElementById("startButton").innerHTML = "Pause";
    document.getElementById("skipButton").classList.remove("d-none");
  } else {
    isTimerRunning = false;
    clearInterval(timerInterval);
    document.getElementById("startButton").innerHTML = "Start";
  }
}

function updateTimer() {
  var timerDisplay = document.getElementById("timer");

  if (minutes === 2 && seconds === 0) {
    playNotificationEndSound(); // Memainkan bunyi notifikasi saat tersisa 2 menit
    showNotification("Sisa Waktu", "Tinggal 2 menit lagi, Disiplin yuk"); // Menampilkan notifikasi web saat tersisa 2 menit

  }

  if (seconds > 0) {
    seconds--;
  } else if (minutes > 0) {
    minutes--;
    seconds = 59;
  } else {
    clearInterval(timerInterval);
    isTimerRunning = false;
    document.getElementById("startButton").innerHTML = "Start";
    document.getElementById("skipButton").classList.add("d-none");
    sessionCount++;
    if (sessionCount >= sessions.length) {
      sessionCount = 0;
    }
    sessionType = sessions[sessionCount].type;
    minutes = sessions[sessionCount].duration;
    seconds = 0;
    document.getElementById("timer").innerHTML =
      formatTime(minutes) + ":" + formatTime(seconds);
    setActiveButton(sessionType);
    playNotificationSound(); // Memainkan bunyi notifikasi saat sesi berakhir
    showNotification("Sesi Berakhir", "Sesi " + sessionType + " telah berakhir."); // Menampilkan notifikasi web saat sesi berakhir

  }

  timerDisplay.innerHTML = formatTime(minutes) + ":" + formatTime(seconds);
}

function formatTime(time) {
  return time < 10 ? "0" + time : time;
}

function skipSession() {
  clearInterval(timerInterval);
  isTimerRunning = false;
  document.getElementById("startButton").innerHTML = "Start";
  document.getElementById("skipButton").classList.add("d-none");
  sessionCount++;
  if (sessionCount >= sessions.length) {
    sessionCount = 0;
  }
  sessionType = sessions[sessionCount].type;
  minutes = sessions[sessionCount].duration;
  seconds = 0;
  document.getElementById("timer").innerHTML =
    formatTime(minutes) + ":" + formatTime(seconds);
  setActiveButton(sessionType);
}

function setSession(type) {
  sessionType = type;
  sessionCount = sessions.findIndex((session) => session.type === type);
  minutes = sessions[sessionCount].duration;
  seconds = 0;
  document.getElementById("timer").innerHTML =
    formatTime(minutes) + ":" + formatTime(seconds);
  setActiveButton(type);
}

function setActiveButton(type) {
  document.getElementById("pomodoroButton").classList.remove("active");
  document.getElementById("shortBreakButton").classList.remove("active");
  document.getElementById("longBreakButton").classList.remove("active");

  if (type === "work") {
    document.getElementById("pomodoroButton").classList.add("active");
  } else if (type === "shortBreak") {
    document.getElementById("shortBreakButton").classList.add("active");
  } else if (type === "longBreak") {
    document.getElementById("longBreakButton").classList.add("active");
  }
}

function playNotificationSound() {
  var audio = new Audio("assets/endSound.mp3");
  audio.play();
}

function playNotificationEndSound() {
  var alarm = new Audio("assets/tersisa.mp3");
  alarm.play();
}



function showNotification(title, message) {
  console.log(Notification.permission)
  if (Notification.permission === "granted") {
    new Notification(title, { body: message });
  } else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(permission => {
      console.log(permission)
      if (permission === "granted") {
        new Notification(title, { body: message });
      }
    });
  }
}


//sttings
// Mengambil elemen close button
var closeButton = document.querySelector(".close");

// Menambahkan event listener untuk menangani klik pada close button
closeButton.addEventListener("click", function (event) {
  event.preventDefault(); // Mencegah aksi default saat tombol diklik

  // Menutup modal setting
  document.getElementById("id01").style.display = "none";
});


document.getElementById("saveButton").addEventListener("click", function (event) {
  event.preventDefault(); // Mencegah form dikirim secara default

  // Mengambil nilai dari input form
  var pomodoroDuration = parseInt(document.getElementsByName("pomodoro")[0].value);
  var shortBreakDuration = parseInt(document.getElementsByName("short-break")[0].value);
  var longBreakDuration = parseInt(document.getElementsByName("long-break")[0].value);

  // Mengubah durasi sesi sesuai dengan nilai yang diinputkan
  sessions[0].duration = pomodoroDuration;
  sessions[1].duration = shortBreakDuration;
  sessions[3].duration = pomodoroDuration;
  sessions[4].duration = shortBreakDuration;
  sessions[6].duration = pomodoroDuration;
  sessions[7].duration = longBreakDuration;

  // Mengatur sesi saat ini berdasarkan perubahan durasi
  setSession(sessionType);
  document.getElementById("id01").style.display = "none";
});


// todo //

//form
const openFormButton = document.getElementById('openFormButton');
const closeFormButton = document.getElementById('closeFormButton');
const taskForm = document.getElementById('taskForm');

openFormButton.addEventListener('click', function () {
  openFormButton.style.display = 'none'; // Mengubah tampilan tombol "Open Form" menjadi none
  closeFormButton.style.display = 'block';
  taskForm.style.display = 'block';
});

closeFormButton.addEventListener('click', function () {
  taskForm.style.display = 'none';
  closeFormButton.style.display = 'none';
  openFormButton.style.display = 'block'; // Mengubah tampilan tombol "Open Form" menjadi block kembali
});

// list todo
function toggleTaskDecoration(checkbox) {
  const label = checkbox.nextElementSibling;
  const taskId = checkbox.getAttribute('data-task-id');
  const isChecked = checkbox.checked;

  if (isChecked) {
    label.style.textDecoration = 'line-through';
    label.classList.add('text-muted');
  } else {
    label.style.textDecoration = 'none';
    label.classList.remove('text-muted');
  }

  // Kirim permintaan AJAX untuk memperbarui status task
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'update_task_status.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log('Task status updated successfully');
    } else if (xhr.readyState === 4) {
      console.error('Error updating task status:', xhr.statusText);
    }
  };
  xhr.send('taskId=' + taskId + '&status=' + (isChecked ? 'completed' : 'pending'));
}

function editTask(taskId) {
  // Mengarahkan pengguna ke halaman edit_task.php dengan taskId sebagai parameter
  window.location.href = 'edit_task.php?taskId=' + taskId;
}

function deleteTask(taskId) {
  // Mengarahkan pengguna ke halaman edit_task.php dengan taskId sebagai parameter
  window.location.href = 'delete_task.php?taskId=' + taskId;
}