<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$team = $data['team'];
$correct = $data['correct'];
$selected = $data['selected'];

if (!isset($_SESSION['scoreA'])) $_SESSION['scoreA'] = 0;
if (!isset($_SESSION['scoreB'])) $_SESSION['scoreB'] = 0;

if ($selected === $correct) {
    if ($team === "A") $_SESSION['scoreA']++;
    if ($team === "B") $_SESSION['scoreB']++;
}

echo json_encode([
    "scoreA" => $_SESSION['scoreA'],
    "scoreB" => $_SESSION['scoreB']
]);
