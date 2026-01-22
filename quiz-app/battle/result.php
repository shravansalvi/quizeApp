<?php
session_start();

$resultLog = $_SESSION['result_log'] ?? [];


if (empty($resultLog)) {
    echo "<h2>No result data available.</h2>";
    echo "<a href='../index.php'>Start Quiz</a>";
    exit;
}



$teamA = $_SESSION['team_a'];
$teamB = $_SESSION['team_b'];

$totalA = 0;
$totalB = 0;
$timeA  = 0;
$timeB  = 0;

/* Calculate totals */
foreach ($resultLog as $row) {
    if ($row['teamA_correct']) {
        $totalA++;
        $timeA += $row['teamA_time'];
    }
    if ($row['teamB_correct']) {
        $totalB++;
        $timeB += $row['teamB_time'];
    }
}

/* Decide winner */
if ($totalA > $totalB) {
    $winner = $teamA;
} elseif ($totalB > $totalA) {
    $winner = $teamB;
} else {
    $winner = ($timeA < $timeB) ? $teamA : $teamB;
}

echo "<pre>";
print_r($_SESSION['result_log']);
exit;

?>
<!DOCTYPE html>
<html>
<head>
<title>Final Result</title>
<style>
body {
    font-family: Arial;
    background: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.outer {
    width: 900px;
    background: #fff;
    padding: 20px;
    border-radius: 20px;
}
.header {
    display: flex;
    justify-content: space-between;
    font-weight: bold;
    margin-bottom: 15px;
}
.inner {
    border: 2px solid #333;
    border-radius: 15px;
    padding: 15px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
th, td {
    border: 1px solid #aaa;
    padding: 8px;
    text-align: center;
}
th {
    background: #eee;
}
.winner-box {
    display: flex;
    justify-content: space-around;
    border-top: 2px solid #333;
    padding-top: 15px;
}
.winner-box div {
    padding: 10px 20px;
    border: 1px solid #333;
    border-radius: 10px;
}
</style>
</head>
<body>

<div class="outer">
    <div class="header">
        <span>TECH HEAD</span>
        <span>IT FEST_2025-26</span>
    </div>

    <div class="inner">
        <h3>Result</h3>

        <table>
    <tr>
        <th>No. of Question</th>
        <th><?= htmlspecialchars($teamA) ?> Points</th>
        <th><?= htmlspecialchars($teamB) ?> Points</th>
    </tr>

    <?php foreach ($resultLog as $row): ?>
    <tr>
        <td>Q<?= $row['q'] ?></td>
        <td><?= $row['teamA_correct'] ? 1 : 0 ?></td>
        <td><?= $row['teamB_correct'] ? 1 : 0 ?></td>
    </tr>
    <?php endforeach; ?>
</table>


        <div class="winner-box">
    <div>
        <b>Winner</b><br>
        <?= htmlspecialchars($winner) ?>
    </div>

    <div>
        <b>Points Gained</b><br>
        <?= $winner === "DRAW" ? "-" : ($winner === $teamA ? $totalA : $totalB) ?>
    </div>

    <div>
        <b>Total Time Taken</b><br>
        <?= $winner === "DRAW" ? "-" : (($winner === $teamA ? $timeA : $timeB) . " sec") ?>
    </div>
</div>

    </div>
</div>

</body>
</html>
