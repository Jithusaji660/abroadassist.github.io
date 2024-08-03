<?php
session_start();
$host = 'localhost';
$db = 'abroadassist_db';
$user = 'root';
$pass = '';

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Form validation
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are required.";
    } elseif ($password != $confirm_password) {
        $errors[] = "Passwords do not match.";
    } else {
        // Check if the username or email already exists
        $result = $conn->query("SELECT * FROM users WHERE username='$username' OR email='$email'");
        if ($result->num_rows > 0) {
            $errors[] = "Username or Email already exists.";
        } else {
            // Hash the password and insert the user into the database
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $conn->query("INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hash')");
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Abroadassist</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 300px;
            animation: slideIn 1s ease-in-out;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form button {
            width: 100%;
            padding: 10px;
            background: #9b59b6;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background: #8e44ad;
        }

        .errors {
            background: #e74c3c;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            animation: fadeIn 1.5s ease-in-out;
        }

        .errors p {
            margin: 0;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div>
        <h2>Register</h2>
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
