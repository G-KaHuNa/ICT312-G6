

<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Initialize the cart if it's not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// If the form is submitted, add the item to the cart
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_name'])) {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];

    // Add the item to the session cart
    $_SESSION['cart'][] = [
        'item_name' => $item_name,
        'price' => $price
    ];

    echo "<script>alert('Item added to order!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Menu - Coastal Cravings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fa;
        }

        .menu-header {
            text-align: center;
            margin: 20px;
            font-size: 2.5rem;
            color: #2c3e50;
        }

        .menu-section {
            margin: 30px auto;
            max-width: 1200px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .menu-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: 250px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .menu-item img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
        }

        .menu-item h3 {
            font-size: 1.5rem;
            color: #2980b9;
            margin: 10px 0;
        }

        .menu-item .price {
            font-size: 1.2rem;
            color: #e74c3c;
            margin-bottom: 15px;
        }

        .menu-item form {
            margin-top: 10px;
        }

        .menu-item button {
            background-color: #27ae60;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .menu-item button:hover {
            background-color: #2ecc71;
        }

        /* Cart Styles */
        .cart-section {
            margin: 20px auto;
            max-width: 800px;
            padding: 15px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .cart-section h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            text-align: center;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #27ae60;
            color: white;
            text-align: center;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>

    <div class="menu-header">
        <h1>Coastal Cravings Menu</h1>
    </div>

    <!-- Seafood Section -->
    <div class="menu-section">
        <!-- Grilled Lobster -->
        <div class="menu-item">
            <img src="GRL.webp" alt="Grilled Lobster">
            <h3>Grilled Lobster</h3>
            <div class="price">$35.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Grilled Lobster">
                <input type="hidden" name="price" value="35.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Shrimp Platter -->
        <div class="menu-item">
            <img src="ShP.webp" alt="Shrimp Platter">
            <h3>Shrimp Platter</h3>
            <div class="price">$28.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Shrimp Platter">
                <input type="hidden" name="price" value="28.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>
        <div class="menu-item">
            <img src="Oyster.webp" alt="Oysters on the Half Shell">
            <h3>Oysters on the Half Shell</h3>
            <div class="price">$21.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Oysters on the Half Shell">
                <input type="hidden" name="price" value="21.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Mojito -->
        <div class="menu-item">
            <img src="Mojito.webp" alt="Mojito">
            <h3>Mojito</h3>
            <div class="price">$10.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Mojito">
                <input type="hidden" name="price" value="10.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Margarita -->
        <div class="menu-item">
            <img src="Tequila.webp" alt="Margarita">
            <h3>Margarita</h3>
            <div class="price">$11.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Margarita">
                <input type="hidden" name="price" value="11.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Craft Beer -->
        <div class="menu-item">
            <img src="CBeer.webp" alt="Craft Beer">
            <h3>Craft Beer</h3>
            <div class="price">$8.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Craft Beer">
                <input type="hidden" name="price" value="8.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Grilled Salmon -->
        <div class="menu-item">
            <img src="GRLS.webp" alt="Grilled Salmon">
            <h3>Grilled Salmon</h3>
            <div class="price">$27.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Grilled Salmon">
                <input type="hidden" name="price" value="27.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Garlic Butter Shrimp -->
        <div class="menu-item">
            <img src="GBS.webp" alt="Garlic Butter Shrimp">
            <h3>Garlic Butter Shrimp</h3>
            <div class="price">$24.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Garlic Butter Shrimp">
                <input type="hidden" name="price" value="24.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Crab Cakes -->
        <div class="menu-item">
            <img src="CC.webp" alt="Crab Cakes">
            <h3>Crab Cakes</h3>
            <div class="price">$22.99</div>
            <form method="post" action="menu.php">
                <input type="hidden" name="item_name" value="Crab Cakes">
                <input type="hidden" name="price" value="22.99">
                <button type="submit">Add to Order</button>
            </form>
        </div>

        <!-- Other items go here -->
    </div>

    <!-- Cart Section -->
    <div class="cart-section">
        <h2>Your Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $cart_item):
                        $total += $cart_item['price'];
                    ?>
                        <tr>
                            <td><?php echo $cart_item['item_name']; ?></td>
                            <td>$<?php echo number_format($cart_item['price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Checkout Button -->
        <?php if (!empty($_SESSION['cart'])): ?>
            <form action="checkout.php" method="post">
                <button type="submit" class="checkout-btn">Checkout</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>

