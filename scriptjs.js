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
