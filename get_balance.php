<?php
session_start();
include "db_conn.php";


$dealer_id = intval($_SESSION['id']);
$stmt = $conn->prepare("SELECT pbalance FROM users WHERE id = ?");
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
    echo "Credit" .  " - " . number_format(0, 2) . "$";
} else {
    if($_SESSION['role']!=='admin' && $_SESSION['role']!=='accountant'){
echo "Credit".  " - " .number_format($balance, 2) . "$";
    }else{
        //echo $_SESSION["name"];
    }
    
}

$stmt->close();
$conn->close();
?>