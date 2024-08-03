<?php
session_start();
$host = 'localhost';
$db = 'abroadassist_db';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['receiver'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $receiver = $conn->real_escape_string($_POST['receiver']);
    $sender = 'admin';

    $conn->query("INSERT INTO messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')");
}

header("Location: admin_dashboard.php");
exit();
?>
