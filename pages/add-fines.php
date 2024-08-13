<?php
session_start();
include "../db_conn.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = isset($_POST['car_id']) ? intval($_POST['car_id']) : 0;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

    // Prepare to update vehicle details
   $stmt = $conn->prepare("INSERT INTO fines (vehicle_id, debt, comment) VALUES (?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("iis", $car_id, $amount, $comment);

    if ($stmt->execute()) {
        $stmt1 = $conn->prepare("UPDATE vehicles SET debt = debt + ? WHERE id = ?");
        if ($stmt1) {
            // Bind parameters and execute the statement
            $stmt1->bind_param("di", $amount, $car_id ); // "d" for double, "i" for integer
            $stmt1->execute();
            $stmt1->close();  
        } else {
            echo "Failed to prepare the SQL statement.";
        }
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>