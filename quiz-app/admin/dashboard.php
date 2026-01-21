<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>

<ul>
  <li><a href="questions/add-question.php">Add Question</a></li>
  <li><a href="results/view-results.php">View Results</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
