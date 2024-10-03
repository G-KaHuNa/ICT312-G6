<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Include the database connection file
include('connection/db_connection.php');

// Check if the item ID is provided
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Item not found.");
    }

    $item = $result->fetch_assoc();
} else {
    die("No item ID provided.");
}

// Handle form submission for updating the item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_item'])) {
    $item_name = htmlspecialchars(trim($_POST['item_name']));
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unit_price']);

    $stmt = $conn->prepare("UPDATE inventory SET item_name = ?, quantity = ?, unit_price = ? WHERE item_id = ?");
    $stmt->bind_param("sidi", $item_name, $quantity, $unit_price, $item_id);

    if ($stmt->execute()) {
        header("Location: inventory.php"); // Redirect back to inventory page
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item - Coastal Craving</title>
    <link rel="stylesheet" href="I.css">
</head>
<body>
    <div class="sidebar">
        <h2>Coastal Craving</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="inventory.php" class="active">Inventory</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Edit Item</h1>
        </header>

        <form method="post">
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" value="<?php echo htmlspecialchars($item['item_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" required>
            </div>
            <div class="form-group">
                <label for="unit_price">Unit Price:</label>
                <input type="number" step="0.01" name="unit_price" value="<?php echo htmlspecialchars(number_format($item['unit_price'], 2)); ?>" required>
            </div>
            <input type="submit" name="update_item" value="Update Item" class="add-btn">
        </form>
    </div>

    <script src="I.js"></script>
</body>
</html>
