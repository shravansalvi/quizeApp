<?php
// -------------------------------
// SAMPLE RESULT ARRAY
// (Replace this with $_SESSION['results'] if needed)
// -------------------------------
$results = [
    ['q'=>1,'teamA_correct'=>'','teamB_correct'=>'','teamA_time'=>0,'teamB_time'=>0],
    ['q'=>2,'teamA_correct'=>'','teamB_correct'=>'','teamA_time'=>0,'teamB_time'=>0],
    ['q'=>3,'teamA_correct'=>'','teamB_correct'=>'','teamA_time'=>0,'teamB_time'=>0],
    ['q'=>4,'teamA_correct'=>'','teamB_correct'=>'','teamA_time'=>0,'teamB_time'=>0],
    ['q'=>5,'teamA_correct'=>'','teamB_correct'=>'','teamA_time'=>0,'teamB_time'=>0],
    ['q'=>6,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>4,'teamB_time'=>5],
    ['q'=>7,'teamA_correct'=>'','teamB_correct'=>1,'teamA_time'=>0,'teamB_time'=>3],
    ['q'=>8,'teamA_correct'=>'','teamB_correct'=>1,'teamA_time'=>0,'teamB_time'=>4],
    ['q'=>9,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>5,'teamB_time'=>6],
    ['q'=>10,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>3,'teamB_time'=>4],
    ['q'=>11,'teamA_correct'=>'','teamB_correct'=>1,'teamA_time'=>0,'teamB_time'=>3],
    ['q'=>12,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>1,'teamB_time'=>2],
    ['q'=>13,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>3,'teamB_time'=>4],
    ['q'=>14,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>2,'teamB_time'=>3],
    ['q'=>15,'teamA_correct'=>1,'teamB_correct'=>1,'teamA_time'=>4,'teamB_time'=>5],
];

// -------------------------------
// TOTALS
// -------------------------------
$teamA_score = 0;
$teamB_score = 0;
$teamA_time  = 0;
$teamB_time  = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Result</title>
    <style>
        body { font-family: Arial; background:#f4f6f8; padding:20px; }
        table { border-collapse: collapse; width:100%; background:#fff; }
        th, td { border:1px solid #ccc; padding:10px; text-align:center; }
        th { background:#222; color:#fff; }
        .win { color:green; font-weight:bold; }
        .lose { color:red; }
        .tie { color:orange; font-weight:bold; }
        h2, h3 { margin-top:20px; }
    </style>
</head>
<body>

<h2>🏁 Quiz Result Table</h2>

<table>
    <thead>
        <tr>
            <th>Question</th>
            <th>Team A</th>
            <th>Team B</th>
            <th>Winner</th>
        </tr>
    </thead>
    <tbody>

<?php foreach ($results as $row): ?>

<?php
$q = $row['q'];

$aCorrect = (int)$row['teamA_correct'];
$bCorrect = (int)$row['teamB_correct'];

$aTime = (int)$row['teamA_time'];
$bTime = (int)$row['teamB_time'];

$winner = "—";
$class  = "";

/* DECISION LOGIC */
if ($aCorrect && $bCorrect) {
    if ($aTime < $bTime) {
        $teamA_score++;
        $winner = "Team A (Faster)";
        $class = "win";
    } elseif ($bTime < $aTime) {
        $teamB_score++;
        $winner = "Team B (Faster)";
        $class = "win";
    } else {
        $winner = "Tie";
        $class = "tie";
    }
} elseif ($aCorrect) {
    $teamA_score++;
    $winner = "Team A";
    $class = "win";
} elseif ($bCorrect) {
    $teamB_score++;
    $winner = "Team B";
    $class = "win";
}

$teamA_time += $aTime;
$teamB_time += $bTime;
?>

<tr>
    <td><?= $q ?></td>
    <td><?= $aCorrect ? "✔ {$aTime}s" : "✖" ?></td>
    <td><?= $bCorrect ? "✔ {$bTime}s" : "✖" ?></td>
    <td class="<?= $class ?>"><?= $winner ?></td>
</tr>

<?php endforeach; ?>

    </tbody>
</table>

<h3>📊 Final Summary</h3>

<p><strong>Team A Score:</strong> <?= $teamA_score ?></p>
<p><strong>Team B Score:</strong> <?= $teamB_score ?></p>

<p><strong>Total Time Team A:</strong> <?= $teamA_time ?> sec</p>
<p><strong>Total Time Team B:</strong> <?= $teamB_time ?> sec</p>

<?php
if ($teamA_score > $teamB_score) {
    echo "<h2 class='win'>🏆 Team A Wins the Match!</h2>";
} elseif ($teamB_score > $teamA_score) {
    echo "<h2 class='win'>🏆 Team B Wins the Match!</h2>";
} else {
    echo "<h2 class='tie'>🤝 Match Draw</h2>";
}
?>

</body>
</html>
