<?php
require_once "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Fetch the request details
    $sql = "SELECT dealer_id, amount FROM balance_requests WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $request = $result->fetch_assoc();

    // Update dealer's balance
    $sql = "UPDATE users SET pbalance = pbalance + ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $request['amount'], $request['dealer_id']);
    $stmt->execute();

     $_SESSION['balance'] += $request['amount'];

    // Update the request status
    $sql = "UPDATE balance_requests SET status = 'confirmed' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Request confirmed successfully";
}

$conn->close();
?>