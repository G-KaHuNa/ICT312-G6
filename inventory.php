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

// Function to handle form submissions
function handleFormSubmission($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_item'])) {
            addItem($conn);
        } elseif (isset($_POST['edit_item'])) {
            editItem($conn);
        }
    }
}

function addItem($conn) {
    $item_name = htmlspecialchars(trim($_POST['item_name']));
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unit_price']);

    $stmt = $conn->prepare("INSERT INTO inventory (item_name, quantity, unit_price, status) VALUES (?, ?, ?, 'Available')");
    $stmt->bind_param("sid", $item_name, $quantity, $unit_price);

    if ($stmt->execute()) {
        echo "<script>alert('New item added successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

function editItem($conn) {
    $item_id = intval($_POST['item_id']);
    $item_name = htmlspecialchars(trim($_POST['item_name']));
    $quantity = intval($_POST['quantity']);
    $unit_price = floatval($_POST['unit_price']);

    $stmt = $conn->prepare("UPDATE inventory SET item_name = ?, quantity = ?, unit_price = ? WHERE item_id = ?");
    $stmt->bind_param("sidi", $item_name, $quantity, $unit_price, $item_id);

    if ($stmt->execute()) {
        echo "<script>alert('Item updated successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $item_id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM inventory WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);

    if ($stmt->execute()) {
        echo "<script>alert('Item deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Fetch inventory items
$sql = "SELECT * FROM inventory";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Handle form submission
handleFormSubmission($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - Coastal Craving</title>
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
            <h1>Inventory</h1>
        </header>

        <h2>Add New Item</h2>
        <form method="post">
            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="unit_price">Unit Price:</label>
                <input type="number" step="0.01" name="unit_price" required>
            </div>
            <input type="submit" name="add_item" value="Add Item" class="add-btn">
        </form>

        <table class="inventory-table">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['item_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                            <td><?php echo htmlspecialchars(number_format($row['unit_price'], 2)); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                            <td>
                                <a href="edit_inventory.php?id=<?php echo $row['item_id']; ?>">Edit</a>
                                <a href="?action=delete&id=<?php echo $row['item_id']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No inventory items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="I.js"></script>
</body>
</html>
