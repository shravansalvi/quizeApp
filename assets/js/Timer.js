// ===============================
// Timer Configuration
// ===============================
let totalTime = 5 * 60; // 5 minutes in seconds
let timerElement = document.getElementById("timer");

// ===============================
// Format Time (MM:SS)
// ===============================
function formatTime(seconds) {
    let min = Math.floor(seconds / 60);
    let sec = seconds % 60;

    return `${min.toString().padStart(2, '0')}:${sec
        .toString()
        .padStart(2, '0')}`;
}

// ===============================
// Countdown Logic
// ===============================
const countdown = setInterval(() => {
    timerElement.textContent = formatTime(totalTime);

    // Warning when time is low
    if (totalTime === 60) {
        alert("⚠️ 1 minute remaining!");
    }

    if (totalTime <= 0) {
        clearInterval(countdown);
        alert("⏰ Time is up! Exam submitted.");
        submitExam(); // from antiCheat.js
    }

    totalTime--;
}, 1000);
