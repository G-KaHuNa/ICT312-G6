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

// If cart is empty, redirect to menu
if (empty($_SESSION['cart'])) {
    header("Location: menu.php");
    exit;
}

// Calculate total amount
$total_amount = 0;
$order_items = "";
foreach ($_SESSION['cart'] as $cart_item) {
    $total_amount += $cart_item['price'];
    $order_items .= $cart_item['item_name'] . ", ";
}
$order_items = rtrim($order_items, ", "); // Remove trailing comma

// Generate a random estimated preparation time (in minutes)
$estimated_time = rand(15, 45); // Between 15 and 45 minutes

// Insert the order into the database
$stmt = $conn->prepare("INSERT INTO orders (customer_name, order_items, total_amount, status, estimated_time) VALUES (?, ?, ?, 'Pending', ?)");
$stmt->bind_param("ssdi", $_SESSION['username'], $order_items, $total_amount, $estimated_time);

if ($stmt->execute()) {
    // Clear the cart after successful checkout
    $_SESSION['cart'] = [];

    // Thank you message and estimated time
    $thank_you_message = "Thank you for your order! Your food will be ready in approximately $estimated_time minutes.";
} else {
    // If something goes wrong, show an error message
    $thank_you_message = "There was an issue processing your order. Please try again.";
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fa;
            text-align: center;
            margin-top: 50px;
        }

        .confirmation-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: auto;
        }

        h1 {
            color: #27ae60;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .order-details {
            margin: 20px 0;
        }

        .order-details strong {
            display: block;
            margin-bottom: 10px;
        }

        .thank-you {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-top: 30px;
        }

        .back-btn {
            background-color: #2980b9;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>

<div class="confirmation-container">
    <h1>Order Confirmation</h1>
    <p><?php echo $thank_you_message; ?></p>
    <div class="order-details">
        <strong>Items Ordered:</strong>
        <p><?php echo $order_items; ?></p>
        <strong>Total Amount:</strong>
        <p>$<?php echo number_format($total_amount, 2); ?></p>
        <strong>Estimated Preparation Time:</strong>
        <p><?php echo $estimated_time; ?> minutes</p>
    </div>

    <a href="menu.php" class="back-btn">Order More</a>
</div>

</body>
</html>
