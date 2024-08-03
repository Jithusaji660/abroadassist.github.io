<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Database connection
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "contact_form_db";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute
    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($password, $hashed_password)) {
        $_SESSION['admin_id'] = $id;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #00bcd4, #00796b); /* Gradient background */
            color: #ffffff;
            animation: fadeInBackground 2s ease-in-out;
        }

        @keyframes fadeInBackground {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #333;
            animation: slideIn 1s ease-in-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .container h2 {
            margin-top: 0;
            animation: fadeInText 1s ease-in-out;
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            animation: fadeInLabel 1.2s ease-in-out;
        }

        @keyframes fadeInLabel {
            from {
                opacity: 0;
                transform: translateX(-10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        input[type="text"], input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            animation: fadeInInput 1.4s ease-in-out;
        }

        @keyframes fadeInInput {
            from {
                opacity: 0;
                transform: translateX(10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        button {
            padding: 10px;
            background-color: #00bcd4; /* Cyan */
            color: #ffffff; /* White */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
            animation: fadeInButton 1.6s ease-in-out;
        }

        @keyframes fadeInButton {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        button:hover {
            background-color: #00796b; /* Teal */
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
