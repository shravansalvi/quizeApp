<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['answers'], $_SESSION['questions'])) {
    header("Location: quiz.php");
    exit;
}

$score = 0;
$total = count($_SESSION['questions']);

foreach ($_SESSION['questions'] as $qid) {
    if (!isset($_SESSION['answers'][$qid])) {
        continue;
    }

    $qid = (int)$qid;
    $res = mysqli_query($conn, "SELECT correct_option FROM questions WHERE id = $qid");
    $row = mysqli_fetch_assoc($res);

    if ($row && $_SESSION['answers'][$qid] === $row['correct_option']) {
        $score++;
    }
}

$_SESSION['score'] = $score;
$_SESSION['total_questions'] = $total;

/* redirect ONCE */
header("Location: result.php");
exit;
