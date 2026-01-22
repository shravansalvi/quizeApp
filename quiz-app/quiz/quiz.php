<?php
session_start();
include("../config/db.php");

/* SAFETY */
if (!isset($_SESSION['questions'], $_SESSION['quiz_start'], $_SESSION['quiz_duration'])) {
    header("Location: ../index.php");
    exit;
}

if (!isset($_SESSION['answers'])) {
    $_SESSION['answers'] = [];
}


if (!isset($_SESSION['page_loaded'])) {
    $_SESSION['page_loaded'] = time();
} else {
    // allow reload but do NOT reset anything
}


/* TIMER */
$elapsed   = time() - $_SESSION['quiz_start'];
$remaining = $_SESSION['quiz_duration'] - $elapsed;

if ($remaining <= 0) {
    header("Location: submit.php");
    exit;
}

/* CURRENT QUESTION */
$current = isset($_GET['q']) ? (int)$_GET['q'] : 1;
$index   = $current - 1;
$total   = count($_SESSION['questions']);

if ($index < 0 || $index >= $total) {
    header("Location: submit.php");
    exit;
}

/* SAVE ANSWER */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['answers'][$_POST['qid']] = $_POST['ans'] ?? null;
}

/* FETCH ONE QUESTION */
$qid = $_SESSION['questions'][$index];
$res = mysqli_query($conn, "SELECT * FROM questions WHERE id=$qid");
$q   = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
</head>
<body>

<h3>Time Left: <span id="timer"></span></h3>
<p>Question <?= $current ?> of <?= $total ?></p>
<?php
$progress = (($current) / $total) * 100;
?>

<div style="width:300px; background:#ddd; height:15px; border-radius:10px;">
  <div style="
      width:<?= $progress ?>%;
      height:100%;
      background:#4caf50;
      border-radius:10px;">
  </div>
</div>

<p><?= $current ?> / <?= $total ?> completed</p>
<form id="quizForm" method="post" action="quiz.php?q=<?= $current + 1 ?>">
    <input type="hidden" name="qid" value="<?= $qid ?>">

    <p><b><?= $q['question'] ?></b></p>

    <label>
        <input type="radio" name="ans" value="A"
        <?= ($_SESSION['answers'][$qid] ?? '') === 'A' ? 'checked' : '' ?>>
        <?= $q['option_a'] ?>
    </label><br>

    <label>
        <input type="radio" name="ans" value="B"
        <?= ($_SESSION['answers'][$qid] ?? '') === 'B' ? 'checked' : '' ?>>
        <?= $q['option_b'] ?>
    </label><br>

    <label>
        <input type="radio" name="ans" value="C"
        <?= ($_SESSION['answers'][$qid] ?? '') === 'C' ? 'checked' : '' ?>>
        <?= $q['option_c'] ?>
    </label><br>

    <label>
        <input type="radio" name="ans" value="D"
        <?= ($_SESSION['answers'][$qid] ?? '') === 'D' ? 'checked' : '' ?>>
        <?= $q['option_d'] ?>
    </label><br><br>

   <!-- BUTTONS -->

<?php if ($current > 1) { ?>
    <button type="submit" formaction="quiz.php?q=<?= $current - 1 ?>">Previous</button>
<?php } ?>

<?php if ($current == $total) { ?>
    <button type="submit" formaction="submit.php">Submit</button>
<?php } else { ?>
    <button type="submit">Next</button>
<?php } ?>

</form>

<input type="hidden" id="time" value="<?= $remaining ?>">

<script src="../assets/js/quiz.js"></script>
<script src="../assets/js/anti-cheat.js"></script>

</body>
</html>
