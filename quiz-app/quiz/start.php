<?php
session_start();
include("../config/db.php");

/* SAFETY */
if (!isset($_POST['name']) || !isset($_POST['category'])) {
    die("Invalid access");
}

/* SAVE USER */
$name = $_POST['name'];
$category = $_POST['category'];

mysqli_query($conn, "INSERT INTO users(name) VALUES('$name')");
$_SESSION['user_id'] = mysqli_insert_id($conn);

/* TIMER */
$_SESSION['quiz_start'] = time();
$_SESSION['quiz_duration'] = 10 * 60;

/* CATEGORY */
$_SESSION['category'] = $category;

/* REDIRECT */
header("Location: quiz.php");
exit;
