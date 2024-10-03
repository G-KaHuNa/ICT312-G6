<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Coastal Cravings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }

        .login-container h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #2980b9;
        }

        .login-container p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 30px;
        }

        .login-container input[type="text"], 
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        .login-container input[type="submit"] {
            background-color: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .login-container input[type="submit"]:hover {
            background-color: #2ecc71;
        }

        .login-container a {
            color: #2980b9;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-container a:hover {
            color: #3498db;
        }

        .login-container .admin-info {
            font-size: 0.9rem;
            color: #999;
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login Form</h2>
        <p class="admin-info">For this exercise, login as: <br>Username: <strong>admin</strong> / Password: <strong>admin</strong></p>
        <form action="login_action.php" method="post">
            <input type="text" name="u_name" placeholder="Username" required>
            <input type="password" name="u_password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <p>Try to access the protected page directly: <a href="protected_page.php">Protected Page</a></p>
    </div>

</body>
</html>
