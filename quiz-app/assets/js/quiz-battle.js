let correctAnswer = "";
let timer = 10;
let interval = null;

let teamAnswers = {
    A: null,
    B: null
};

let scores = {
    A: 0,
    B: 0
};

/* LOAD QUESTION */
function loadQuestion() {
    clearInterval(interval);

    teamAnswers = { A: null, B: null };

    fetch("fetch-question.php")
        .then(res => res.json())
        .then(q => {

            /* END AFTER 15 QUESTIONS */
            if (q.end) {
                window.location.href = "result.php";
                return;
            }

            document.getElementById("question").innerText =
                `Q${q.count}. ${q.question}`;

            document.getElementById("nextQuestion").innerText =
                "Waiting for both teams…";

            correctAnswer = q.correct;

            document.querySelectorAll(".opt").forEach(btn => {
                btn.innerText = q.options[btn.dataset.opt];
                btn.disabled = false;
                btn.style.background = "";
            });

            startTimer();
        });
}

/* TIMER */
function startTimer() {
    timer = 10;
    document.getElementById("timer").innerText = timer;

    interval = setInterval(() => {
        timer--;
        document.getElementById("timer").innerText = timer;

        if (timer <= 0) {
            clearInterval(interval);
            evaluateAnswer();
        }
    }, 1000);
}

/* OPTION CLICK */
document.querySelectorAll(".opt").forEach(btn => {
    btn.addEventListener("click", () => {

        const team = btn.dataset.team;
        const opt  = btn.dataset.opt;

        // Each team can answer only once
        if (teamAnswers[team] !== null) return;

        teamAnswers[team] = opt;

        // Visual feedback (selected but not judged yet)
        btn.style.background = "#ddd";
    });
});

/* EVALUATE AFTER 10 SECONDS */
function evaluateAnswer() {

    document.querySelectorAll(".opt").forEach(btn => {
        btn.disabled = true;

        const team = btn.dataset.team;
        const opt  = btn.dataset.opt;

        // Correct option → green
        if (opt === correctAnswer) {
            btn.style.background = "green";
        }

        // Wrong selection → red
        if (
            teamAnswers[team] === opt &&
            opt !== correctAnswer
        ) {
            btn.style.background = "red";
        }
    });

    // Score update
    if (teamAnswers.A === correctAnswer) {
        scores.A++;
        document.getElementById("scoreA").innerText = scores.A;
    }

    if (teamAnswers.B === correctAnswer) {
        scores.B++;
        document.getElementById("scoreB").innerText = scores.B;
    }

    document.getElementById("nextQuestion").innerText =
        "Click here for next question";
}

/* NEXT QUESTION CLICK */
document.getElementById("nextQuestion").addEventListener("click", () => {
    loadQuestion();
});

/* INITIAL LOAD */
loadQuestion();
