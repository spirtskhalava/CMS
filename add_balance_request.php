<?php
require_once "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['dealer_id']) && isset($_POST['date']) && isset($_POST['amount']) && isset($_POST['user'])){

    $dealer_id = $_POST['dealer_id'];
    $request_date = $_POST['date'];
    $amount = $_POST['amount'];
    $person_name = $_POST['user'];

    $sql = "INSERT INTO balance_requests (dealer_id, request_date, amount, person_name) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("isds", $dealer_id, $request_date, $amount, $person_name);

    if ($stmt->execute()) {
        echo "Request submitted successfully";
    } else {
        echo "Error submitting request: " . $stmt->error;
    }

    $stmt->close();
  }
}

$conn->close();
?>
