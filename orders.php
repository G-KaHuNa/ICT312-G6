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

// If the form from the menu page is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_name'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $customer_name = $_SESSION['username']; // Assuming customer's name is stored in the session

    // Insert the new order into the 'orders' table
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, order_date, total_amount, status) VALUES (?, NOW(), ?, 'Pending')");
    $stmt->bind_param("sd", $customer_name, $price);

    if ($stmt->execute()) {
        echo "<script>alert('Order placed successfully!');</script>";
    } else {
        echo "<script>alert('Error placing order: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Fetch orders from the database
$sql = "SELECT * FROM orders WHERE customer_name = ?";  // Fetch orders only for the logged-in customer
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Coastal Craving</title>
    <link rel="stylesheet" href="D.css">
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
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Orders Content -->
    <div class="main-content">
        <header>
            <h1>Your Orders</h1>
        </header>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['order_date']; ?></td>
                            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="Dj.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
