<?php
$servername = "localhost";  // Change this if your server settings are different
$username = "root";         // Default MySQL username
$password = "";             // Default MySQL password, change if needed
$dbname = "w5";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

