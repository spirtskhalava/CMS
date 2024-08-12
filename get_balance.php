<?php
session_start();
include "db_conn.php";

$dealer_id = intval($_SESSION['id']);

// Fetch the balance from the database
$stmt = $conn->prepare("SELECT balance FROM dealers WHERE id = ?");
$stmt->bind_param("i", $dealer_id);
$stmt->execute();
$stmt->bind_result($balance);
$stmt->fetch();

if ($balance === null) {
    echo "Balance not found.";
} else {
    echo $_SESSION["name"] . " - " . number_format($balance, 2) . "$";
}

$stmt->close();
$conn->close();
?>