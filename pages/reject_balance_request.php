<?php
require_once "../db_conn.php";
// Check connection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']); // Sanitize and convert to integer

    // Update the request status to 'rejected'
    $stmt = $conn->prepare("UPDATE balance_requests SET status = 'rejected' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Request rejected successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>