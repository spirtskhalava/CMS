<?php
// Include database connection
require_once "db_conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Retrieve data from form
$username = $_POST['user'];
$auction = $_POST['auction'];
$Auctionuser = $_POST['auctionuser'];
$code = $_POST['code'];

// Sanitize input (prevent SQL injection)
$auction = $conn->real_escape_string($auction);
$code = $conn->real_escape_string($code);
$Auctionuser = $conn->real_escape_string($Auctionuser);

// Construct and execute SQL query
$sql = "INSERT INTO buyers (user_id, code, auction,auctionuser) VALUES ('$username', '$code','$auction','$Auctionuser')";

if ($conn->query($sql) === TRUE) {
    header("Location: pages/add-buyer.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
}
?>
