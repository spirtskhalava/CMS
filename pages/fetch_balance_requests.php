<?php
session_start();
require_once "../db_conn.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the role is set in the session
if (!isset($_SESSION['role'])) {
    http_response_code(400); // Bad request if role is not set
    echo json_encode(['error' => 'Role not set in session']);
    exit;
}

$id = intval($_SESSION['id']); // Convert to integer for safety

// Construct SQL query based on the role
if ($_SESSION['role'] === 'dealer') {
    $sql = "SELECT br.id, d.name AS dealer_name, br.request_date, br.amount, br.person_name, br.status 
            FROM balance_requests br
            JOIN users d ON br.dealer_id = d.id
            WHERE br.dealer_id = ?";
} else {
    $sql = "SELECT br.id, d.name AS dealer_name, br.request_date, br.amount, br.person_name, br.status 
            FROM balance_requests br
            JOIN users d ON br.dealer_id = d.id";
}

// Prepare and execute the SQL query
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    http_response_code(500); // Internal server error
    echo json_encode(['error' => 'SQL prepare failed: ' . $conn->error]);
    exit;
}

if ($_SESSION['role'] === 'dealer') {
    $stmt->bind_param("i", $id);
}

$stmt->execute();
$result = $stmt->get_result();

$requests = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $requests[] = $row;
    }
}

// Output the result as JSON
header('Content-Type: application/json'); // Set content type to JSON
echo json_encode($requests);

$stmt->close();
$conn->close();
?>