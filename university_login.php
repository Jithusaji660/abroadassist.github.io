<?php
session_start();
include 'config.php'; // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user
    $query = "SELECT * FROM universities WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['university_id'] = $user['id'];
            $_SESSION['university_name'] = $user['university_name'];
            $_SESSION['success'] = "Login successful!";
            // Redirect to the university dashboard or homepage
            header('Location: university_dashboard.php');
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>University Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            z-index: 10;
            animation: fadeIn 1s ease-in-out;
        }

        h3 {
            margin-bottom: 20px;
            animation: slideInFromLeft 1s ease-in-out;
        }

        form {
            display: flex;
            flex-direction: column;
            animation: fadeIn 1.5s ease-in-out;
        }

        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
            animation: slideInFromRight 1.5s ease-in-out;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #87e9dc;
            box-shadow: 0 0 8px rgba(135, 233, 220, 0.5);
        }

        button {
            padding: 10px;
            background-color: #87e9dc;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            animation: bounceIn 2s ease-in-out;
        }

        button:hover {
            background-color: #6cc6b2;
        }

        p {
            margin-top: 20px;
            color: #ff0000;
            animation: fadeIn 2s ease-in-out;
        }

        .bubble {
            position: absolute;
            bottom: -100px;
            width: 40px;
            height: 40px;
            background-color: #87e9dc;
            border-radius: 50%;
            opacity: 0.5;
            animation: rise 8s infinite ease-in;
        }

        .bubble:nth-child(2) {
            width: 20px;
            height: 20px;
            left: 20%;
            animation-duration: 6s;
        }

        .bubble:nth-child(3) {
            width: 30px;
            height: 30px;
            left: 40%;
            animation-duration: 7s;
        }

        .bubble:nth-child(4) {
            width: 50px;
            height: 50px;
            left: 60%;
            animation-duration: 9s;
        }

        .bubble:nth-child(5) {
            width: 25px;
            height: 25px;
            left: 80%;
            animation-duration: 5s;
        }

        @keyframes rise {
            0% {
                bottom: -100px;
                transform: translateX(0);
            }
            50% {
                transform: translateX(100px);
            }
            100% {
                bottom: 100vh;
                transform: translateX(-200px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInFromLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideInFromRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes bounceIn {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>University Login</h3>
        <form action="university_login.php" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
    <div class="bubble"></div>
</body>
</html>
