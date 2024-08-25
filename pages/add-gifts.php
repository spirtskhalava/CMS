<?php
session_start();
include "../db_conn.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_id = isset($_POST['car_id']) ? intval($_POST['car_id']) : 0;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';

    // Retrieve the user_id associated with the vehicle
   $stmt = $conn->prepare("
    SELECT users.username, vehicles.vin 
    FROM vehicles 
    JOIN users ON vehicles.user_id = users.id 
    WHERE vehicles.id = ?
");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $stmt->bind_result($userId, $vin);
    $stmt->fetch();
    $stmt->close();

    if ($userId === null) {
        die("Error: User not found for the vehicle.");
    }

    // Prepare to insert into fines
    $stmt = $conn->prepare("INSERT INTO fines (vehicle_id, debt, comment) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("iis", $car_id, $amount, $comment);

    if ($stmt->execute()) {
        // Prepare to update vehicle debt
        $stmt1 = $conn->prepare("UPDATE vehicles SET debt = debt - ? WHERE id = ?");
        if ($stmt1) {
            $stmt1->bind_param("di", $amount, $car_id);
            $stmt1->execute();
            $stmt1->close();

            // Log the action
            $logAction = "DISCOUNT";
            $logDetails = "$amount was gifted to $userId vehicle $vin";
            $stmt = $conn->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("iss", $userId, $logAction, $logDetails);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Failed to prepare the log SQL statement.";
            }
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
