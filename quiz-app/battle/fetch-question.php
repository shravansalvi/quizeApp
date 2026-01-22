<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['question_count'])) {
    $_SESSION['question_count'] = 0;
}

/* 🔥 NORMAL ROUND = 15 QUESTIONS
   🔥 TIE-BREAKER = 1 QUESTION ONLY */
if (!empty($_SESSION['tie_breaker'])) {
    if ($_SESSION['question_count'] >= 1) {
        echo json_encode(["end" => true]);
        exit;
    }
} else{
    if (empty($_SESSION['tie_breaker']) && $_SESSION['question_count'] >= 15) {
    $_SESSION['normal_round_over'] = true;   // ✅ MARK NORMAL ROUND DONE
    echo json_encode(["end" => true]);
    exit;
}
}

/* FETCH SQL QUESTION */
$sql = "
    SELECT id, question, option_a, option_b, option_c, option_d, correct_option
    FROM questions
    WHERE category = 'sql'
    ORDER BY RAND()
    LIMIT 1
";

$res = mysqli_query($conn, $sql);

if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode(["error" => "No SQL questions available"]);
    exit;
}

/* INCREMENT COUNT */
$_SESSION['question_count']++;

$q = mysqli_fetch_assoc($res);

echo json_encode([
    "end" => false,
    "count" => $_SESSION['question_count'],
    "question" => $q['question'],
    "options" => [
        "A" => $q['option_a'],
        "B" => $q['option_b'],
        "C" => $q['option_c'],
        "D" => $q['option_d']
    ],
    "correct" => $q['correct_option']
]);
