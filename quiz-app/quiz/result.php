<?php
session_start();

if (!isset($_SESSION['score'], $_SESSION['total_questions'])) {
    echo "No result found. Please attempt quiz again.";
    exit;
}

$score = $_SESSION['score'];
$total = $_SESSION['total_questions'];

if ($total <= 0) {
    echo "Invalid result data.";
    exit;
}

$percent = round(($score / $total) * 100, 2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
</head>
<body>

<h2>Quiz Result</h2>

<p><strong>Score:</strong> <?= $score ?> / <?= $total ?></p>
<p><strong>Percentage:</strong> <?= $percent ?>%</p>

<?php if ($percent >= 40): ?>
    <h3 style="color:green;">PASS 🎉</h3>
<?php else: ?>
    <h3 style="color:red;">FAIL ❌</h3>
<?php endif;
