<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
</head>
<body>

<h2>Admin Login</h2>

<form method="post" action="">
  <input type="text" name="username" placeholder="Admin Username" required><br><br>
  <input type="password" name="password" placeholder="Password" required><br><br>
  <button type="submit">Login</button>
</form>

<?php
if ($_POST) {
    if ($_POST['username'] == "admin" && $_POST['password'] == "admin123") {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
    } else {
        echo "<p style='color:red'>Invalid Login</p>";
    }
}
?>

</body>
</html>
