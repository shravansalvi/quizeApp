<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("../config/db.php");

if (!isset($_SESSION['quiz_start'])) {
    header("Location: ../index.php");
    exit;
}

$category = $_SESSION['category'];
$elapsed = time() - $_SESSION['quiz_start'];
$remaining = $_SESSION['quiz_duration'] - $elapsed;

if ($remaining <= 0) {
    header("Location: submit.php");
    exit;
}

$questions = mysqli_query(
    $conn,
    "SELECT * FROM questions
WHERE category='$category'
ORDER BY RAND()
LIMIT 15
"
);
?>

<h3>Time Left: <span id="timer"></span></h3>
<input type="hidden" id="time" value="<?= $remaining ?>">

<form id="quizForm" method="post" action="submit.php">

<?php $i = 1; while ($q = mysqli_fetch_assoc($questions)) { ?>
    <p><b><?= $i ?>. <?= $q['question'] ?></b></p>

    <label>
      <input type="radio" name="ans[<?= $q['id'] ?>]" value="A">
      <?= $q['option_a'] ?>
    </label><br>

    <label>
      <input type="radio" name="ans[<?= $q['id'] ?>]" value="B">
      <?= $q['option_b'] ?>
    </label><br>

    <label>
      <input type="radio" name="ans[<?= $q['id'] ?>]" value="C">
      <?= $q['option_c'] ?>
    </label><br>

    <label>
      <input type="radio" name="ans[<?= $q['id'] ?>]" value="D">
      <?= $q['option_d'] ?>
    </label><br><br>

<?php $i++; } ?>

<button type="submit">Submit Quiz</button>
</form>

<script src="../assets/js/quiz.js"></script>
<script src="../assets/js/anti-cheat.js"></script>
