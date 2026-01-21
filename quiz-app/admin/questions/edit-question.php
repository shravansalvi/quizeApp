<?php
session_start();
include("../../config/db.php");

$id = $_GET['id'];
$q = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM questions WHERE id=$id"));
?>

<form method="post">
<textarea name="question"><?= $q['question'] ?></textarea><br>
<input type="text" name="a" value="<?= $q['option_a'] ?>"><br>
<input type="text" name="b" value="<?= $q['option_b'] ?>"><br>
<input type="text" name="c" value="<?= $q['option_c'] ?>"><br>
<input type="text" name="d" value="<?= $q['option_d'] ?>"><br>

<select name="correct">
<option selected><?= $q['correct_option'] ?></option>
<option>A</option><option>B</option><option>C</option><option>D</option>
</select>

<button type="submit">Update</button>
</form>

<?php
if ($_POST) {
    mysqli_query($conn, "UPDATE questions SET
    question='$_POST[question]',
    option_a='$_POST[a]',
    option_b='$_POST[b]',
    option_c='$_POST[c]',
    option_d='$_POST[d]',
    correct_option='$_POST[correct]'
    WHERE id=$id");

    header("Location: ../dashboard.php");
}
?>