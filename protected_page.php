<?php
session_start();

if (!isset($_SESSION['u_name']) || $_SESSION['u_name'] !== 'admin') {
    echo "<h2>You cannot be here</h2>";
    echo "<a href='index.php'>Go back to Login</a>";
    exit();
} else {
    echo "<h2>You see this message because you have logged in as admin</h2>";
}
?>

<form method="post" action="index.php">
    <input type="submit" name="logout" value="Log out">
</form>
