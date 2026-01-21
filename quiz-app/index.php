<!DOCTYPE html>
<html>
<head>
  <title>Quiz App</title>
</head>
<body>
  <h2>Enter Your Name</h2>
  <form action="quiz/start.php" method="post">
  <input type="text" name="name" required>

  <select name="category" required>
    <option value="SQL">SQL</option>
    <option value="JAVA">JAVA</option>
    <option value="APTITUDE">APTITUDE</option>
  </select>

  <button type="submit">Start Quiz</button>
</form>

  </form>
</body>
</html>
