var pomodoroTime = 25; // 25 minutes in seconds
var shortBreakTime = 5 ; // 5 minutes in seconds
var longBreakTime = 15 ; // 15 minutes in seconds

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
  updateTimerLabel(); // Update timer label without starting the timer
  updateTimeDisplay(); // Update time display without starting the timer
  updateCircleProgress();
}

function updateTimer() {
  timeLeft--;

  if (timeLeft < 0) {
    clearInterval(timerInterval);
    switchSession();
    updateTimerLabel(); // Update timer label without starting the timer
    updateTimeDisplay(); // Update time display without starting the timer
    playButton.disabled = false; // Enable the play button
  }

  updateTimeDisplay(); // Update time display every second
  updateCircleProgress(); // Update circle progress every second
}

function switchSession() {
  if (sessionType === 'pomodoro') {
    sessionType = 'shortBreak';
    timeLeft = shortBreakTime;
    circleProgress.style.stroke = '#009688';
  } else if (sessionType === 'shortBreak') {
    sessionType = 'pomodoro';
    timeLeft = pomodoroTime;
    circleProgress.style.stroke = '#FF5722';
  }

  updateTimerLabel(); // Update timer label after switching session
}

function updateTimerLabel() {
  if (sessionType === 'pomodoro') {
    timerLabel.textContent = 'Pomodoro';
  } else if (sessionType === 'shortBreak') {
    timerLabel.textContent = 'Short Break';
  }
}

function updateTimeDisplay() {
  var minutes = Math.floor(timeLeft / 60);
  var seconds = timeLeft % 60;

  timeDisplay.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
}

function updateCircleProgress() {
  var totalTime;

  if (sessionType === 'pomodoro') {
    totalTime = pomodoroTime;
  } else if (sessionType === 'shortBreak') {
    totalTime = shortBreakTime;
  }

  var progress = 100 - ((timeLeft / totalTime) * 100);
  circleProgress.style.strokeDashoffset = (progress * 502.65) / 100;
}

updateTimerLabel(); // Set initial timer label
updateTimeDisplay(); // Set initial time display
updateCircleProgress(); // Set initial circle progress
