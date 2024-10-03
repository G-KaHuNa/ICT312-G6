<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coastal Cravings</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: url('HO.webp') no-repeat center center fixed;
            background-size: cover;
            padding-top: 80px;
        }

        /* Navigation bar */
        .navbar {
            /*display: flex; */
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .navbar h1 {
            color: #fff;
            font-size: 24px;
            letter-spacing: 2px;
        }

        .navbar ul {
            list-style-type: none;
        }

        .navbar ul li {
            display: inline-block;
            margin: 0 15px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            transition: color 0.3s;
        }

        .navbar ul li a:hover {
            color: #f1c40f;
        }

        /* Main Content */
        .main-content {
            height: 100%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding-left: 80px;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
        }

        .main-content h1 {
            font-size: 60px;
            margin-bottom: 20px;
            max-width: 500px;
        }

        .main-content p {
            font-size: 24px;
            margin-bottom: 40px;
        }

        .btn-reserve {
            display: inline-block;
            padding: 15px 30px;
            background-color: #27ae60;
            color: white;
            font-size: 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-reserve:hover {
            background-color: #219653;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <h1>Coastal Cravings</h1>
        <ul>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div>
            <h1>TASTE OF OCEAN ON YOUR TABLE</h1>
            <p>Enjoy the freshest seafood delivered straight to your table.</p>
            <a href="reservations1.php" class="btn-reserve">Reserve a Table</a>
        </div>
    </div>

</body>
</html>
