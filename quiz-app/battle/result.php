<?php
session_start();

$a = $_SESSION['scoreA'] ?? 0;
$b = $_SESSION['scoreB'] ?? 0;

if ($a > $b) $winner = $_SESSION['team_a'];
elseif ($b > $a) $winner = $_SESSION['team_b'];
else $winner = "DRAW";
?>
<h1>Result</h1>
<h2>Winner: <?= $winner ?></h2>
<p><?= $_SESSION['team_a'] ?>: <?= $a ?></p>
<p><?= $_SESSION['team_b'] ?>: <?= $b ?></p>
