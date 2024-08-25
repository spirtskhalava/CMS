<?php
include "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vin = $_POST['vin'] ?? '';

    if (!empty($vin)) {
        $sql = "SELECT id, vin, make, model FROM vehicles WHERE vin = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo json_encode(['success' => false, 'message' => 'Prepare failed: (' . $conn->errno . ') ' . $conn->error]);
            exit;
        }

        $stmt->bind_param("s", $vin);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($vehicle = $result->fetch_assoc()) {
            echo json_encode(['success' => true, 'vehicle' => $vehicle]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No vehicle found.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'VIN code is required.']);
    }

    $conn->close();
} else {
    header("HTTP/1.1 405 Method Not Allowed");
}
?>