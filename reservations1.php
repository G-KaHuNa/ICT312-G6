<?php
// Start the session
session_start();

// Include the database connection file
include('connection/db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get the input values
    $customer_name = htmlspecialchars($_POST['name']);
    $customer_email = htmlspecialchars($_POST['email']);
    $phone_number = htmlspecialchars($_POST['phone']);
    $reservation_date = $_POST['date'];
    $reservation_time = $_POST['time'];
    $number_of_guests = $_POST['guests'];
    $special_request = htmlspecialchars($_POST['specialRequest']);

    // Insert the reservation into the database
    $stmt = $conn->prepare("INSERT INTO reservations (customer_name, customer_email, phone_number, reservation_date, reservation_time, number_of_guests, special_request) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("sssssis", $customer_name, $customer_email, $phone_number, $reservation_date, $reservation_time, $number_of_guests, $special_request);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to the confirmation page after successful reservation
            header("Location: reservation_confirm.php");
            exit;
        } else {
            echo "<script>alert('Error submitting reservation: " . $stmt->error . "');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->error . "');</script>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Reservation - Coastal Cravings</title>
    <link rel="stylesheet" href="R.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .reservation-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .reservation-box h2 {
            text-align: center;
            color: #27ae60;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 1rem;
            color: #333;
        }

        .input-group input, .input-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .input-group textarea {
            resize: none;
            height: 100px;
        }

        .btn-reserve {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .btn-reserve:hover {
            background-color: #219653;
        }
    </style>
</head>
<body>

    <!-- Reservation Form Container -->
    <div class="reservation-container">
        <div class="reservation-box">
            <h2>Reserve a Table</h2>
            <form action="" method="POST" id="reservationForm">
                <!-- By leaving action empty, form submits to reservation1.php itself -->
                <div class="input-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="input-group">
                    <label for="date">Reservation Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="input-group">
                    <label for="time">Reservation Time</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="input-group">
                    <label for="guests">Number of Guests</label>
                    <input type="number" id="guests" name="guests" min="1" max="20" placeholder="Enter number of guests" required>
                </div>
                <div class="input-group">
                    <label for="specialRequest">Special Requests (optional)</label>
                    <textarea id="specialRequest" name="specialRequest" placeholder="Any special requests?"></textarea>
                </div>
                <button type="submit" class="btn-reserve">Reserve Now</button>
            </form>
        </div>
    </div>

</body>
</html>
