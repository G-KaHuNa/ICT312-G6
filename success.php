<?php
session_start();
if (!isset($_SESSION['u_name'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
</head>
<body>
    <h2>Login Successful</h2>
    <p>Welcome, <?php echo $_SESSION['u_name']; ?>!</p>
    <a href="protected_page.php">Go to protected page</a><br><br>
    <a href="index.php">Log out</a>
</body>
</html>
