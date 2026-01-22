<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['result_log'])) {
    $_SESSION['result_log'] = [];
}

/* prevent duplicate save */
foreach ($_SESSION['result_log'] as $row) {
    if ($row['q'] == $data['q']) {
        session_write_close();
        echo json_encode(["status" => "duplicate"]);
        exit;
    }
}

$_SESSION['result_log'][] = $data;

/* 🔥 FORCE SESSION SAVE */
session_write_close();

echo json_encode(["status" => "saved"]);
