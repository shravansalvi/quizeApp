<?php
session_start();
include("../../config/db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

$data = mysqli_query($conn, "
SELECT users.name, results.score, results.total_questions, results.submitted_at
FROM results
JOIN users ON users.id = results.user_id
");
?>

<h2>Quiz Results</h2>

<table border="1" cellpadding="5">
<tr>
  <th>Name</th>
  <th>Score</th>
  <th>Total</th>
  <th>Date</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($data)) { ?>
<tr>
  <td><?= $row['name'] ?></td>
  <td><?= $row['score'] ?></td>
  <td><?= $row['total_questions'] ?></td>
  <td><?= $row['submitted_at'] ?></td>
</tr>
<?php } ?>
</table>
