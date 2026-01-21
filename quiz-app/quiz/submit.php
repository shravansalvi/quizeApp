

<?php
session_start();
include("../config/db.php");

/* =====================
   SESSION SAFETY CHECK
===================== */
if (
    !isset($_SESSION['quiz_start']) ||
    !isset($_SESSION['quiz_duration']) ||
    !isset($_SESSION['user_id'])
) {
    die("Invalid quiz session. Please start the quiz properly.");
}

/* =====================
   TIME VALIDATION
===================== */
$expired = false;
if (time() - $_SESSION['quiz_start'] > $_SESSION['quiz_duration']) {
    $expired = true;
}

/* =====================
   ANSWER SAFETY CHECK
===================== */
$answers = $_POST['ans'] ?? [];   // ← KEY FIX

$score = 0;

foreach ($answers as $qid => $ans) {
    $res = mysqli_query($conn, "SELECT correct_option FROM questions WHERE id=$qid");
    if ($row = mysqli_fetch_assoc($res)) {
        if ($ans === $row['correct_option']) {
            $score++;
        }
    }
}

/* =====================
   SAVE RESULT SAFELY
===================== */
$user_id = $_SESSION['user_id'];
$total = count($answers);

mysqli_query($conn, "
INSERT INTO results (user_id, score, total_questions)
VALUES ($user_id, $score, $total)
");

/* =====================
   CLEAN SESSION
===================== */
unset($_SESSION['quiz_start']);
unset($_SESSION['quiz_duration']);

$_SESSION['score'] = $score;

header("Location: result.php");
echo "<pre>";
print_r($_SESSION);
print_r($_POST);
exit;

