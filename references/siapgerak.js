var pomodoroTime = 25 * 60; // 25 minutes in seconds
var shortBreakTime = 5 * 60; // 5 minutes in seconds
var longBreakTime = 15 * 60; // 15 minutes in seconds

var sessionType = 'pomodoro'; // initial session type
var timeLeft = pomodoroTime; // initial time left
var timerInterval;

var playButton = document.getElementById('play-btn');
var pauseButton = document.getElementById('pause-btn');
var skipButton = document.getElementById('skip-btn');
var timerLabel = document.getElementById('timer-label');
var timeDisplay = document.getElementById('time-left');
var progressBar = document.querySelector('.progress');

playButton.addEventListener('click', startTimer);
pauseButton.addEventListener('click', pauseTimer);
skipButton.addEventListener('click', skipTimer);

function startTimer() {
  timerInterval = setInterval(updateTimer, 1000);
  playButton.disabled = true;
  pauseButton.disabled = false;
  skipButton.disabled = false;
}

function pauseTimer() {
  clearInterval(timerInterval);
  playButton.disabled = false;
  pauseButton.disabled = true;
  skipButton.disabled = false;
}

function skipTimer() {
  clearInterval(timerInterval);
  playButton.disabled = false;
  pauseButton.disabled = true;
  skipButton.disabled = true;
  switchSession();
}

function updateTimer() {
  var minutes = Math.floor(timeLeft / 60);
  var seconds = timeLeft % 60;

  timeDisplay.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

  var progress = 100 - ((timeLeft / getTimeLimit()) * 100);
  progressBar.style.clipPath = 'circle(' + progress + '% at 50% 50%)';

  timeLeft--;

  if (timeLeft < 0) {
    clearInterval(timerInterval);
    switchSession();
  }
}

function switchSession() {
  if (sessionType === 'pomodoro') {
    sessionType = 'shortBreak';
    timeLeft = shortBreakTime;
    timerLabel.textContent = 'Short Break';
  } else if (sessionType === 'shortBreak') {
    sessionType = 'pomodoro';
    timeLeft = pomodoroTime;
    timerLabel.textContent = 'Pomodoro';
  }
}

function getTimeLimit() {
  if (sessionType === 'pomodoro') {
    return pomodoroTime;
  } else if (sessionType === 'shortBreak') {
    return shortBreakTime;
  } else if (sessionType === 'longBreak') {
    return longBreakTime;
  }
}