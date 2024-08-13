<?php
session_start();
include "db_conn.php";


$dealer_id = intval($_SESSION['id']);

// Fetch the balance from the database
$stmt = $conn->prepare("SELECT SUM(debt) as total_debt FROM vehicles WHERE user_id = ?");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $dealer_id);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$stmt->bind_result($balance);
$stmt->fetch();

if ($balance === null) {
    echo "Debt - " . number_format(0, 2) . "$";
} else {
    echo "Debt - " . number_format($balance, 2) . "$";
}

$stmt->close();
$conn->close();
?>