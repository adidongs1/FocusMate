var pomodoroTime = 30 ; // 25 minutes in seconds
var shortBreakTime = 15 ; // 5 minutes in seconds
var longBreakTime = 25 ; // 15 minutes in seconds

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
    timeLeft.textContent = '05:00'
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


/*
var sessionType = 'pomodoro'; // initial session type
var timeLeft = pomodoroTime; // initial time left
var timerInterval;

var playButton = document.getElementById('play-btn');
var pauseButton = document.getElementById('pause-btn');
var skipButton = document.getElementById('skip-btn');
var timerLabel = document.getElementById('timer-label');
var timeDisplay = document.getElementById('time-left');
var circleProgress = document.getElementById('tt');

playButton.addEventListener('click', startTimer);
pauseButton.addEventListener('click', pauseTimer);
skipButton.addEventListener('click', skipTimer);

function startTimer() {
  if (timeLeft === getTimeLimit()) {
    timerInterval = setInterval(updateTimer, 1000);
  }
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
  startTimer(); // Restart the timer after skipping
}

function updateTimer() {
  timeLeft--;

  if (timeLeft < 0) {
    clearInterval(timerInterval);
    switchSession();
    startTimer(); // Restart the timer after switching session
    return;
  }

  timeDisplay.textContent = formatTime(timeLeft);
  var progress = 100 - ((timeLeft / getTimeLimit()) * 100);
  circleProgress.style.strokeDashoffset = (progress * 502.65) / 100;
}

function formatTime(time) {
  var minutes = Math.floor(time / 60);
  var seconds = time % 60;
  return minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
}

function switchSession() {
  clearInterval(timerInterval);

  if (sessionType === 'pomodoro') {
    sessionType = 'shortBreak';
    timeLeft = shortBreakTime;
    timerLabel.textContent = 'Short Break';
    circleProgress.style.stroke = '#009688';
  } else if (sessionType === 'shortBreak') {
    sessionType = 'pomodoro';
    timeLeft = pomodoroTime;
    timerLabel.textContent = 'Pomodoro';
    circleProgress.style.stroke = '#FF5722';
  }

  timeDisplay.textContent = formatTime(timeLeft);
  var progress = 100 - ((timeLeft / getTimeLimit()) * 100);
  circleProgress.style.strokeDashoffset = (progress * 502.65) / 100;
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

*/
