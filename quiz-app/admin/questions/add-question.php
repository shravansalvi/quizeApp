<?php
session_start();
include("../../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Question</title>
</head>
<body>

<h2>Add New Question</h2>

<form method="post">
  <textarea name="question" placeholder="Question" required></textarea><br><br>
  <input type="text" name="a" placeholder="Option A" required><br>
  <input type="text" name="b" placeholder="Option B" required><br>
  <input type="text" name="c" placeholder="Option C" required><br>
  <input type="text" name="d" placeholder="Option D" required><br><br>

  Correct Option:
  <select name="correct">
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
    <option value="D">D</option>
  </select><br><br>

  <button type="submit">Save Question</button>
</form>

<?php
if ($_POST) {
    mysqli_query($conn, "INSERT INTO questions 
    (question, option_a, option_b, option_c, option_d, correct_option)
    VALUES (
      '$_POST[question]',
      '$_POST[a]',
      '$_POST[b]',
      '$_POST[c]',
      '$_POST[d]',
      '$_POST[correct]'
    )");

    echo "<p style='color:green'>Question Added Successfully</p>";
}
?>

</body>
</html>
