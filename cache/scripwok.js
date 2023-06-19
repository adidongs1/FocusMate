// JavaScript code for Pomodoro Timer
let timerInterval;
let remainingTime = 1500; // 25 minutes in seconds
let isRunning = false;
let isBreak = false;
let sessionCount = 0;
const sessionLimit = 4;
const shortBreakTime = 300; // 5 minutes in seconds
const longBreakTime = 900; // 15 minutes in seconds

const timerElement = document.getElementById('timer');
const startButton = document.getElementById('startButton');
const skipButton = document.getElementById('skipButton');
const sessionLabel = document.getElementById('sessionLabel');
const counterElement = document.getElementById('counter');
const resetCounterButton = document.getElementById('resetCounterButton');

function startTimer() {
  isRunning = true;
  startButton.innerText = 'Pause';
  startButton.classList.remove('btn-primary');
  startButton.classList.add('btn-danger');
  skipButton.classList.remove('d-none');

  timerInterval = setInterval(() => {
    remainingTime--;
    updateTimer();

    if (remainingTime <= 0) {
      clearInterval(timerInterval);
      if (!isBreak) {
        sessionCount++;
        if (sessionCount < sessionLimit) {
          // Short break
          startBreakTimer(shortBreakTime);
          sessionLabel.innerText = 'Short Break';
        } else {
          // Long break
          startBreakTimer(longBreakTime);
          sessionLabel.innerText = 'Long Break';
        }
      } else {
        // After break, start new session
        startTimer();
        sessionLabel.innerText = 'Pomodoro Session';
      }
      updateCounter();
    }
  }, 1000);
}

function startBreakTimer(breakTime) {
  isBreak = true;
  remainingTime = breakTime;
  updateTimer();
  startTimer();
}

function pauseTimer() {
  isRunning = false;
  startButton.innerText = 'Resume';
  startButton.classList.remove('btn-danger');
  startButton.classList.add('btn-primary');
  clearInterval(timerInterval);
}

function skipTimer() {
  if (isBreak) {
    clearInterval(timerInterval);
    isBreak = false;
    remainingTime = 1500;
    updateTimer();
    startTimer();
    sessionLabel.innerText = 'Pomodoro Session';
  } else if (!isRunning) {
    sessionCount++;
    if (sessionCount < sessionLimit) {
      startBreakTimer(shortBreakTime);
      sessionLabel.innerText = 'Short Break';
    } else {
      sessionCount = 0;
      startBreakTimer(longBreakTime);
      sessionLabel.innerText = 'Long Break';
    }
    updateCounter();
  }
}

function updateTimer() {
  const minutes = Math.floor(remainingTime / 60).toString().padStart(2, '0');
  const seconds = (remainingTime % 60).toString().padStart(2, '0');
  timerElement.innerText = `${minutes}:${seconds}`;
}

function updateCounter() {
  counterElement.innerText = `Pomodoro Count: ${sessionCount}`;
}

function resetTimer() {
  isRunning = false;
  isBreak = false;
  remainingTime = 1500;
  updateTimer();
  startButton.innerText = 'Start';
  startButton.classList.remove('btn-danger');
  startButton.classList.add('btn-primary');
  skipButton.classList.add('d-none');
  sessionLabel.innerText = 'Pomodoro Session';
}

function resetCounter() {
  sessionCount = 0;
  updateCounter();
}

startButton.addEventListener('click', () => {
  if (!isRunning) {
    startTimer();
  } else {
    pauseTimer();
  }
});

skipButton.addEventListener('click', () => {
  skipTimer();
});

resetCounterButton.addEventListener('click', () => {
  resetCounter();
});