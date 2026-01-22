let correctAnswer = "";
let timer = 10;
let interval;
let canGoNext = false;

let teamAnswers = { A: null, B: null };
let answerTime = { A: null, B: null };   // ✅ ADD
let scores = { A: 0, B: 0 };
let currentQuestionNo = 0;

/* ✅ BIND NEXT QUESTION CLICK ONCE */
document.getElementById("nextQuestion").onclick = () => {
    if (!canGoNext) return;
    loadQuestion();
};

function loadQuestion() {
    canGoNext = false;
    teamAnswers = { A: null, B: null };
    answerTime = { A: null, B: null };   // ✅ RESET
    clearInterval(interval);

    document.getElementById("nextQuestion").innerText =
        "Waiting for timer…";

    fetch("fetch-question.php")
        .then(r => r.json())
        .then(q => {

            if (q.end) {
                setTimeout(() => {
                    window.location.href = "result.php";
                }, 300);
                return;
            }

            /* ✅ FIX: SET QUESTION NUMBER */
            currentQuestionNo = q.count;

            document.getElementById("question").innerText =
                (window.isTieBreaker ? "🔥 SUDDEN DEATH" : "Q" + q.count) +
                ": " + q.question;

            correctAnswer = q.correct;

            document.querySelectorAll(".opt").forEach(btn => {
                btn.innerText = q.options[btn.dataset.opt];
                btn.disabled = false;
                btn.style.background = "";
            });

            startTimer();
        });
}

function startTimer() {
    timer = 10;
    document.getElementById("timer").innerText = timer;

    interval = setInterval(() => {
        timer--;
        document.getElementById("timer").innerText = timer;

        if (timer <= 0) {
            clearInterval(interval);
            evaluate();
        }
    }, 1000);
}

/* ✅ CAPTURE ANSWER TIME ON CLICK */
document.querySelectorAll(".opt").forEach(btn => {
    btn.onclick = () => {
        const t = btn.dataset.team;
        if (teamAnswers[t] !== null) return;

        teamAnswers[t] = btn.dataset.opt;
        answerTime[t] = 10 - timer;   // ✅ FIX TIME
        btn.style.background = "#ddd";
    };
});

function evaluate() {

    document.querySelectorAll(".opt").forEach(btn => {
        btn.disabled = true;

        if (btn.dataset.opt === correctAnswer)
            btn.style.background = "green";

        if (
            teamAnswers[btn.dataset.team] === btn.dataset.opt &&
            btn.dataset.opt !== correctAnswer
        )
            btn.style.background = "red";
    });

    const teamA_correct = teamAnswers.A === correctAnswer;
    const teamB_correct = teamAnswers.B === correctAnswer;

    if (teamA_correct) {
        scores.A++;
        document.getElementById("scoreA").innerText = scores.A;
    }
    if (teamB_correct) {
        scores.B++;
        document.getElementById("scoreB").innerText = scores.B;
    }

    /* ✅ USE STORED ANSWER TIME */
    const teamA_time = teamA_correct ? answerTime.A : 0;
    const teamB_time = teamB_correct ? answerTime.B : 0;

    /* ✅ GUARANTEED SAVE */
    navigator.sendBeacon(
        "save-result.php",
        JSON.stringify({
            q: currentQuestionNo,
            teamA_correct,
            teamB_correct,
            teamA_time,
            teamB_time
        })
    );

    canGoNext = true;

    if (window.isTieBreaker) {
        document.getElementById("nextQuestion").innerText =
            "Evaluating result…";
        setTimeout(() => {
            window.location.href = "result.php";
        }, 800);
    } else {
        document.getElementById("nextQuestion").innerText =
            "Click for next question";
    }
}

/* ✅ START GAME */
loadQuestion();
