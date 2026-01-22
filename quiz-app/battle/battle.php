<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['team_a'], $_SESSION['team_b'])) {
    header("Location: ../team-entry.php");
    exit;
}

if (!isset($_SESSION['question_count'])) {
    $_SESSION['question_count'] = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Battle</title>
    <link rel="stylesheet" href="../assets/css/battle.css">
</head>
<body>

<div class="outer">
    <div class="header">
        <span>TECH HEAD</span>
        <span>IT FEST_2025-26</span>
    </div>

    <div class="quiz-box">
        <h2 id="question">Loading...</h2>
        <div id="timer">10</div>

        <div class="options">
            <div class="team">
                <h3><?= $_SESSION['team_a'] ?></h3>
                <button class="opt" data-team="A" data-opt="A"></button>
                <button class="opt" data-team="A" data-opt="B"></button>
                <button class="opt" data-team="A" data-opt="C"></button>
                <button class="opt" data-team="A" data-opt="D"></button>
            </div>

            <div class="team">
                <h3><?= $_SESSION['team_b'] ?></h3>
                <button class="opt" data-team="B" data-opt="A"></button>
                <button class="opt" data-team="B" data-opt="B"></button>
                <button class="opt" data-team="B" data-opt="C"></button>
                <button class="opt" data-team="B" data-opt="D"></button>
            </div>
        </div>

        <div class="footer">
            <span id="scoreA">0</span>
            <span>VS</span>
            <span id="scoreB">0</span>
        </div>

        <div id="nextQuestion" class="next-question">
    Click here for next question
</div>

    </div>
</div>

<script src="../assets/js/quiz-battle.js"></script>
</body>
</html>
