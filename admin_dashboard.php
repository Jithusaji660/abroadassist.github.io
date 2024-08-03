<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$host = 'localhost';
$db = 'abroadassist_db';
$user = 'root';
$pass = '';

// Connect to the database
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve messages
$sql = "SELECT id, name, email, message, submitted_at FROM messages ORDER BY submitted_at DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Error executing query: " . $conn->error);
}

// Fetch chat messages
$chat_sql = "SELECT * FROM messages ORDER BY submitted_at ASC";
$chat_result = $conn->query($chat_sql);

if (!$chat_result) {
    die("Error executing chat query: " . $conn->error);
}

$chat_messages = $chat_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            padding: 20px;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .chat-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            animation: fadeIn 1s ease-in-out;
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">Admin Dashboard</h2>
        <div class="table-container fade-in">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['message'] . "</td>
                                    <td>" . $row['submitted_at'] . "</td>
                                    <td>
                                        <a href='send_email.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Send Email</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No messages found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="chat-box">
            <h4 class="text-center">Chat with Users</h4>
            <div class="messages">
                <?php foreach ($chat_messages as $msg): ?>
                    <div class="message">
                        <div class="sender"><?php echo htmlspecialchars($msg['sender'] ?? 'Unknown'); ?>:</div>
                        <div class="text"><?php echo htmlspecialchars($msg['message'] ?? ''); ?></div>
                        <div class="timestamp"><?php echo htmlspecialchars($msg['submitted_at'] ?? ''); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <form method="post" action="send_message_admin.php">
                <input type="text" name="receiver" placeholder="Type receiver's username here..." required>
                <input type="text" name="message" placeholder="Type your message here..." required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
