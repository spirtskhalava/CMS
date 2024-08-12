<?php
session_start();
include "../db_conn.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
 print_r($id);
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM vehicles WHERE id = ?");
        
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: admin.php?message=Vehicle deleted successfully");
        } else {
             header("Location: admin.php?message=Error: " . $stmt->error);
        }

        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>