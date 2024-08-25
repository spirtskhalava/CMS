<?php
session_start();
include "db_conn.php";

// Get the location parameter from GET request
$brand = isset($_GET['location']) ? trim($_GET['location']) : '';

// Prepare SQL query with JOIN and WHERE clause using a placeholder for parameter binding
$sql = "SELECT data.destination_id, data.from_title, containers.id, containers.container_from
        FROM data
        INNER JOIN containers ON data.destination_id = containers.id
        WHERE data.from_title = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

// Bind the parameter and execute the statement
$stmt->bind_param("s", $brand);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the results
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row['container_from'];
}

echo json_encode($rows);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
