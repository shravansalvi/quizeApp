document.addEventListener("DOMContentLoaded", function () {
    const timeInput = document.getElementById("time");
    const timerEl = document.getElementById("timer");

    if (!timeInput || !timerEl) return;

    let time = parseInt(timeInput.value);
    if (isNaN(time)) return;

    const interval = setInterval(() => {
        let min = Math.floor(time / 60);
        let sec = time % 60;

        timerEl.textContent =
            min + ":" + (sec < 10 ? "0" : "") + sec;

        time--;

        if (time < 0) {
            clearInterval(interval);
            alert("Time Over! Submitting quiz.");
            document.getElementById("quizForm").submit();
        }
    }, 1000);
});
