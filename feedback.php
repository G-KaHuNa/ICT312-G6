<?php
// Start session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Include the database connection file
include('connection/db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $customer_name = htmlspecialchars($_POST['customer-name']);
    $customer_email = htmlspecialchars($_POST['customer-email']);
    $feedback_text = htmlspecialchars($_POST['feedback-text']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (customer_name, customer_email, feedback_text) VALUES (?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sss", $customer_name, $customer_email, $feedback_text);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to confirmation page
            header("Location: feedback_confirm.php");
            exit;
        } else {
            echo "<script>alert('Error submitting feedback: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback - Coastal Cravings</title>
    <link rel="stylesheet" href="St.css">
</head>
<body>
    <div class="feedback-container">
        <h2>Submit Your Feedback</h2>
        <form method="POST" action="feedback.php">
            <div class="form-group">
                <label for="customer-name">Name:</label>
                <input type="text" name="customer-name" id="customer-name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="customer-email">Email:</label>
                <input type="email" name="customer-email" id="customer-email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="feedback-text">Feedback:</label>
                <textarea name="feedback-text" id="feedback-text" rows="5" placeholder="Write your feedback here" required></textarea>
            </div>
            <button type="submit" class="submit-btn">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
