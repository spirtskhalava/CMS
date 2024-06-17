<?php
// Include database connection
require_once "db_conn.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Retrieve data from form
$username = $_POST['user'];
$auction = $_POST['auction'];
$code = $_POST['code'];

// Sanitize input (prevent SQL injection)
$auction = $conn->real_escape_string($auction);
$code = $conn->real_escape_string($code);

// Construct and execute SQL query
$sql = "INSERT INTO buyers (user_id, code, auction) VALUES ('$username', '$code','$auction')";

if ($conn->query($sql) === TRUE) {
    header("Location: pages/add-buyer.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
}
?>
