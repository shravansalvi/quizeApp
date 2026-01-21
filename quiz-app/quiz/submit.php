<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['answers'], $_SESSION['questions'], $_SESSION['user_id'])) {
    die("Invalid session");
}

$score = 0;

foreach ($_SESSION['answers'] as $qid => $ans) {
    if (!$ans) continue;

    $res = mysqli_query($conn, "SELECT correct_option FROM questions WHERE id=$qid");
    $row = mysqli_fetch_assoc($res);

    if ($ans === $row['correct_option']) {
        $score++;
    }
}

$user_id = $_SESSION['user_id'];
$total = count($_SESSION['questions']);

mysqli_query($conn, "
INSERT INTO results (user_id, score, total_questions)
VALUES ($user_id, $score, $total)
");

$_SESSION['score'] = $score;

/* CLEAN */
unset($_SESSION['questions'], $_SESSION['answers']);

header("Location: result.php");
exit;
?>