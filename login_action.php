<?php
include 'connection/db_connection.php';

$u_name = $_POST['u_name'];
$u_password = $_POST['u_password'];

// Use a prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT u_name, u_password, role FROM users WHERE u_name = ? AND u_password = ?");
$stmt->bind_param("ss", $u_name, $u_password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch the user's data
    $row = $result->fetch_assoc();
    
    session_start();
    $_SESSION['username'] = $u_name;  // Storing the username in the session
    $_SESSION['role'] = $row['role'];  // Storing the user's role in the session

    // Redirect based on the user's role
    if ($row['role'] == 'admin') {
        header("Location: dashboard.php");
    } elseif ($row['role'] == 'customer') {
        header("Location: HOME.php");
    } else {
        // Default redirection if role is not recognized
        header("Location: dashboard.php");
    }
} else {
    // If the username or password is incorrect
    header("Location: fail.php");
}

$stmt->close();
$conn->close();
?>
