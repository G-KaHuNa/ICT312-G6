<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Include the database connection file
include('connection/db_connection.php');

// Fetch reservation data from the database
$sqlReservations = "SELECT reservation_id, customer_name, customer_email, phone_number, reservation_date, reservation_time, number_of_guests FROM reservations ORDER BY reservation_date DESC";
$resultReservations = $conn->query($sqlReservations);

if (!$resultReservations) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations - Coastal Cravings</title>
    <link rel="stylesheet" href="D.css">
</head>
<body>

    <!-- Sidebar for Navigation -->
    <div class="sidebar">
        <h2>CoastalCravings</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="reservations.php" class="active">Reservations</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content: Reservations List -->
    <div class="main-content">
        <header>
            <h1>Reservations</h1>
        </header>

        <section class="reservations">
            <table border="1" cellpadding="10" cellspacing="0">
                <tr>
                    <th>Reservation ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Number of Guests</th>
                </tr>
                <?php
                // Loop through each reservation and display it in a table row
                if ($resultReservations->num_rows > 0) {
                    while ($row = $resultReservations->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['reservation_id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['customer_email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                        echo "<td>" . $row['reservation_date'] . "</td>";
                        echo "<td>" . $row['reservation_time'] . "</td>";
                        echo "<td>" . $row['number_of_guests'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No reservations found.</td></tr>";
                }
                ?>
            </table>
        </section>
    </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
