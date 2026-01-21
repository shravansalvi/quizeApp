<?php
session_start();
include("../config/db.php");

$name = $_POST['name'];
$category = $_POST['category'];

mysqli_query($conn, "INSERT INTO users(name) VALUES('$name')");
$_SESSION['user_id'] = mysqli_insert_id($conn);

/* TIMER */
$_SESSION['quiz_start'] = time();
$_SESSION['quiz_duration'] = 10 * 60;

/* CATEGORY */
$_SESSION['category'] = $category;

/* LOCK 15 QUESTIONS */
$q = mysqli_query(
    $conn,
    "SELECT id FROM questions
     WHERE category='$category'
     ORDER BY RAND()
     LIMIT 15"
);

$_SESSION['questions'] = [];

$q = mysqli_query($conn,"
SELECT id FROM questions
WHERE category='$category'
ORDER BY RAND()
LIMIT 15
");

while ($row = mysqli_fetch_assoc($q)) {
    $_SESSION['questions'][] = $row['id'];
}

$_SESSION['answers'] = [];


header("Location: quiz.php?q=1");
exit;
?>