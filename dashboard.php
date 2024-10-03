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

// Fetching data from the database
$sqlReservations = "SELECT COUNT(*) AS totalReservations FROM reservations";
$resultReservations = $conn->query($sqlReservations);
$rowReservations = $resultReservations->fetch_assoc();
$totalReservations = $rowReservations['totalReservations'];

$sqlOrders = "SELECT COUNT(*) AS totalOrders FROM orders";
$resultOrders = $conn->query($sqlOrders);
$rowOrders = $resultOrders->fetch_assoc();
$totalOrders = $rowOrders['totalOrders'];

$sqlInventory = "SELECT COUNT(*) AS inventoryItems FROM inventory";
$resultInventory = $conn->query($sqlInventory);
$rowInventory = $resultInventory->fetch_assoc();
$inventoryItems = $rowInventory['inventoryItems'];

$oeeEfficiency = 92;  // Placeholder - can be calculated based on your data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Coastal Craving</title>
    <link rel="stylesheet" href="D.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- For Graphs -->
</head>
<body>

    <!-- Sidebar for Navigation -->
    <div class="sidebar">
        <h2>CostalCraving</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="feedback_admin.php">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Dashboard Content -->
    <div class="main-content">
        <header>
            <h1>Dashboard</h1>
        </header>

        <section class="stats-cards">
            <div class="card">
                <h3>Total Reservations</h3>
                <p><?php echo $totalReservations; ?></p>
            </div>
            <div class="card">
                <h3>Total Orders</h3>
                <p><?php echo $totalOrders; ?></p>
            </div>
            <div class="card">
                <h3>Inventory Items</h3>
                <p><?php echo $inventoryItems; ?></p>
            </div>
            <div class="card">
                <h3>OEE Efficiency</h3>
                <p><?php echo $oeeEfficiency; ?>%</p>
            </div>
        </section>

        <section class="charts">
            <div class="chart-container">
                <h3>Orders by Day</h3>
                <canvas id="ordersChart"></canvas>
            </div>
            <div class="chart-container">
                <h3>Inventory Levels</h3>
                <canvas id="inventoryChart"></canvas>
            </div>
        </section>
    </div>

    <script src="Dj.js"></script>
</body>
</html>
