<?php
include 'config.php'; // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $university_name = $_POST['university_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new university into the database
    $query = "INSERT INTO universities (university_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $university_name, $email, $hashed_password);

    if ($stmt->execute()) {
        $success = "Registration successful. You can now <a href='university_login.php'>login</a>.";
        $bubbles_class = "green-bubble";
    } else {
        $error = "Registration failed. Please try again.";
        $bubbles_class = "";
    }
} else {
    $bubbles_class = "";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>University Registration</title>
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

        .registration-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            z-index: 10;
        }

        h3 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #87e9dc;
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
        }

        button:hover {
            background-color: #6cc6b2;
        }

        p {
            margin-top: 20px;
        }

        p.success {
            color: green;
        }

        p.error {
            color: red;
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

        .green-bubble {
            background-color: #6cc6b2;
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
    </style>
</head>
<body>
    <div class="registration-container">
        <h3>University Registration</h3>
        <form action="university_register.php" method="post">
            <input type="text" name="university_name" placeholder="University Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <?php if (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
    <div class="bubble <?php echo $bubbles_class; ?>"></div>
    <div class="bubble <?php echo $bubbles_class; ?>"></div>
    <div class="bubble <?php echo $bubbles_class; ?>"></div>
    <div class="bubble <?php echo $bubbles_class; ?>"></div>
    <div class="bubble <?php echo $bubbles_class; ?>"></div>
</body>
</html>
