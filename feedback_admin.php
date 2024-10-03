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

// Fetch feedback records from the database
$feedbacks = $conn->query("SELECT customer_name, customer_email, feedback_text, created_at FROM feedback ORDER BY created_at DESC");

if (!$feedbacks) {
    die("Error fetching feedback: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Feedback View - Coastal Cravings</title>
    <link rel="stylesheet" href="D.css">
</head>
<body>

    <!-- Sidebar for Navigation -->
    <div class="sidebar">
        <h2>Coastal</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="feedback_admin.php" class="active">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Customer Feedback</h1>
        </header>

        <section class="feedback-table-section">
            <h2>All Customer Feedback</h2>
            <table class="feedback-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Feedback</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $feedbacks->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['feedback_text']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>

</body>
</html>
