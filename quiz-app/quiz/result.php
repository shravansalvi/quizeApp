<?php
session_start();

if (!isset($_SESSION['result'])) {
    header("Location: ../index.php");
    exit;
}

$score = $_SESSION['result']['score'];
$total = $_SESSION['result']['total'];
$time  = $_SESSION['result']['time'];

$minutes = floor($time / 60);
$seconds = $time % 60;

/* prevent refresh resubmit */
unset($_SESSION['result']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
</head>
<body>

<h2>Quiz Completed ✅</h2>

<p><b>Score:</b> <?= $score ?> / <?= $total ?></p>
<p><b>Time Taken:</b> <?= $minutes ?> min <?= $seconds ?> sec</p>

<a href="../index.php">Start New Quiz</a>

</body>
</html>
