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

// Fetch user details
$result = $conn->query("SELECT * FROM users WHERE username='$username'");
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome - Abroadassist</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #87e9dc;
            color: #fff;
            padding: 15px 20px;
        }
        
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        nav ul li {
            margin-left: 20px;
        }
        
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #84878a;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        nav ul li a:hover {
            background-color: #7d838a;
        }
        
        main {
            padding: 20px;
        }
        
        .welcome {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }
        
        .welcome h2 {
            margin-top: 0;
            font-size: 28px;
            color: #333;
            animation: slideInDown 1s ease-in-out;
        }
        
        .welcome p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }
        
        .welcome a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #87e9dc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        .welcome a:hover {
            background-color: #6cc6b2;
        }

        .chat-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px 0;
            max-width: 600px;
            margin: 20px auto;
            text-align: left;
        }

        .chat-box .messages {
            max-height: 300px;
            overflow-y: auto;
            margin-bottom: 20px;
        }

        .chat-box .message {
            margin-bottom: 10px;
        }

        .chat-box .message .sender {
            font-weight: bold;
        }

        .chat-box form {
            display: flex;
            align-items: center;
        }

        .chat-box input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .chat-box button {
            padding: 10px 20px;
            background-color: #87e9dc;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .chat-box button:hover {
            background-color: #6cc6b2;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #a8cef5;
            color: #fff;
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
    <header>
        <h1>Abroadassist</h1>
        <nav>
            <ul>
                <li><a href="http://localhost/ha/next.html">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <p>Name: <?php echo htmlspecialchars($user['name']); ?></p>
            <p>Score: <?php echo htmlspecialchars($user['Marks']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
            <p>Address: <?php echo htmlspecialchars($user['address']); ?></p>
            <a href="profile.php">Edit Profile</a>
        </section>

        <section class="chat-box">
            <h4 class="text-center">Chat with Admin</h4>
            <div class="messages">
                <?php
                // Fetch chat messages
                $chat_sql = "SELECT * FROM messages WHERE sender='$username' OR receiver='$username' ORDER BY submitted_at ASC";
                $chat_result = $conn->query($chat_sql);

                if ($chat_result->num_rows > 0) {
                    while ($msg = $chat_result->fetch_assoc()) {
                        echo "<div class='message'>
                                <div class='sender'>" . htmlspecialchars($msg['sender']) . ":</div>
                                <div class='text'>" . htmlspecialchars($msg['message']) . "</div>
                                <div class='timestamp'>" . htmlspecialchars($msg['submitted_at']) . "</div>
                              </div>";
                    }
                } else {
                    echo "<div class='message'>No messages yet</div>";
                }
                ?>
            </div>
            <form method="post" action="send_message.php">
                <input type="text" name="message" placeholder="Type your message here..." required>
                <input type="hidden" name="receiver" value="admin">
                <button type="submit">Send</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; Abroadassist</p>
    </footer>
</body>
</html>
