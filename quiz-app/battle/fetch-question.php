<?php
session_start();
include("../config/db.php");

/* STOP AFTER 15 QUESTIONS */
if (!isset($_SESSION['question_count'])) {
    $_SESSION['question_count'] = 0;
}

if ($_SESSION['question_count'] >= 15) {
    echo json_encode(["end" => true]);
    exit;
}

/* FETCH ONLY SQL QUESTIONS */
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

/* INCREMENT QUESTION COUNT */
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
