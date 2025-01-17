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

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['receiver'])) {
    $message = $conn->real_escape_string($_POST['message']);
    $receiver = $conn->real_escape_string($_POST['receiver']);
    $sender = $username;

    $conn->query("INSERT INTO messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')");
}

header("Location: welcome.php");
exit();
?>
