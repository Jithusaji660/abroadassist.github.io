<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

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

// Get message ID
$id = intval($_GET['id']);

// Retrieve message details
$sql = "SELECT name, email, message FROM messages WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $email, $message);
$stmt->fetch();
$stmt->close();

// Send email
$to = $email;
$subject = "Response to Your Message";
$body = "Dear $name,\n\nThank you for reaching out. Here is your message:\n\n$message";
$headers = "From: jithukadaplackal@gmail.com";

if (mail($to, $subject, $body, $headers)) {
    echo "Email sent successfully.";
} else {
    echo "Failed to send email.";
}

// Close the connection
$conn->close();
?>
