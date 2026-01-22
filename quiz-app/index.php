<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['start'])) {

        unset(
            $_SESSION['question_count'],
            $_SESSION['result_log'],
            $_SESSION['scoreA'],
            $_SESSION['scoreB'],
            $_SESSION['tie_breaker'],
            $_SESSION['normal_round_over']
        );

        $_SESSION['team_a'] = $_POST['team_a'];
        $_SESSION['team_b'] = $_POST['team_b'];

        header("Location: battle/battle.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Team Entry</title>
    <style>
        body {
            font-family: Arial;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .outer {
            width: 700px;
            border: 2px solid #333;
            border-radius: 20px;
            padding: 20px;
        }
        .top {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }
        .inner {
            border: 2px solid #333;
            border-radius: 20px;
            padding: 30px;
            margin-top: 20px;
            text-align: center;
        }
        input {
            width: 70%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 20px;
        }
        .btns {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
        }
        button {
            padding: 10px 30px;
            border-radius: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="outer">
    <div class="top">
        <span>TECH HEAD</span>
        <span>IT FEST_2025-26</span>
    </div>

    <div class="inner">
        <h2>Team Entry</h2>

        <!-- 🔴 FORM IS REQUIRED -->
        <form method="post">

            <input type="text" name="team_a" placeholder="Enter Team A Name" required>
            <input type="text" name="team_b" placeholder="Enter Team B Name" required>

            <div class="btns">
                <!-- IMPORTANT: type="submit" + name -->
                <button type="submit" name="result">Result</button>
                <button type="submit" name="start">Start</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
