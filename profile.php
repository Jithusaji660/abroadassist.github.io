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

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $Marks = $conn->real_escape_string($_POST['Marks']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    // Update the user's personal details in the database
    if ($conn->query("UPDATE users SET name='$name', Marks='$Marks', phone='$phone', address='$address' WHERE username='$username'") === TRUE) {
        // Set the success message
        $_SESSION['update_success'] = "Profile updated successfully.You can go back";
    } else {
        $errors[] = "Error updating profile: " . $conn->error;
    }

    // Fetch updated user details
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();
} else {
    // Fetch current user details
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile - Abroadassist</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            animation: slideInDown 1s ease-in-out;
        }

        .profile-form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            animation: fadeIn 1s ease-in-out;
        }

        .profile-form label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        .profile-form input[type="text"],
        .profile-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .profile-form button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #87e9dc;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .profile-form button:hover {
            background-color: #6cc6b2;
        }

        .errors, .success {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
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
    <h2>Profile</h2>
    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['update_success'])): ?>
        <div class="success">
            <p><?php echo $_SESSION['update_success']; ?></p>
        </div>
        <?php unset($_SESSION['update_success']); ?>
    <?php endif; ?>
    <form class="profile-form" action="profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        
        <label for="Marks">Score:</label>
        <input type="text" id="Marks" name="Marks" value="<?php echo htmlspecialchars($user['Marks']); ?>" required>
        
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        
        <label for="address">Address:</label>
        <textarea id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>
        
        <button type="submit">Update Profile</button>
        
    </form>
</body>
</html>
