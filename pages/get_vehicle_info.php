<?php
session_start();
include "../db_conn.php";

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $vehicleId = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM fines WHERE vehicle_id = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("i", $vehicleId);
    $stmt->execute();
    $result = $stmt->get_result();

    $fines = [];
    while ($row = $result->fetch_assoc()) {
        $fines[] = $row;
    }

    if (count($fines) > 0) {
        echo json_encode($fines);
    } else {
        echo json_encode(["error" => "No data found"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>