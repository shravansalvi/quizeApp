document.addEventListener("DOMContentLoaded", function () {
  const timeInput = document.getElementById("time");
  if (!timeInput) return;

  let time = parseInt(timeInput.value);
  if (isNaN(time)) return;

  const timerEl = document.getElementById("timer");

  const interval = setInterval(() => {
    let min = Math.floor(time / 60);
    let sec = time % 60;

    timerEl.innerText =
      min + ":" + (sec < 10 ? "0" : "") + sec;

    time--;

    if (time < 0) {
      clearInterval(interval);
      alert("Time Over! Submitting quiz.");
      document.getElementById("quizForm").submit();
    }
  }, 1000);
});
