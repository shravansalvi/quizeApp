<?php
session_start();
echo "<h2>Your Score: " . $_SESSION['score'] . "</h2>";
session_destroy();
