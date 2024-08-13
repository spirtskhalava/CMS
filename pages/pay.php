<?php
session_start();
include "../db_conn.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $paid_amount = isset($_POST['sum']) ? floatval($_POST['sum']) : 0;
    $user_id=intval($_SESSION['id']);
    $userId=intval($_SESSION['id']);
     $current_debt='';
     $zero=0;

    if ($vehicle_id > 0 && $paid_amount > 0) {
        // Begin transaction
        $conn->begin_transaction();
        try {
            // Fetch current debt and user ID
            $stmt = $conn->prepare("SELECT debt, user_id FROM vehicles WHERE id = ?");
            $stmt->bind_param("i", $vehicle_id);
            $stmt->execute();
            $stmt->bind_result($current_debt, $user_id);
            $stmt->fetch();
            $stmt->close();

            if ($current_debt === null) {
                throw new Exception("Vehicle not found.");
            }

            // Determine new debt and amount to deduct from user balance
            if ($paid_amount >= $current_debt) {
                // If paid amount is greater than or equal to the current debt
                $remaining_debt = 0;
                $credit_amount = $paid_amount - $current_debt; // Amount left to credit
            } else {
                // If paid amount is less than current debt
                $remaining_debt = $current_debt - $paid_amount;
                $credit_amount = 0;
            }

            $stmt = $conn->prepare("UPDATE users SET pbalance = pbalance + ? WHERE id = ?");
            $stmt->bind_param("di", $credit_amount, $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Error updating user balance: " . $stmt->error);
            }
            $stmt->close();


            $stmt = $conn->prepare("UPDATE users SET pbalance = pbalance - ? WHERE id = ?");
            $stmt->bind_param("di", $current_debt, $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Error updating user balance: " . $stmt->error);
            }
            $stmt->close();

            $stmt = $conn->prepare("UPDATE vehicles SET debt = ? WHERE id = ?");
            $stmt->bind_param("ii",  $zero, $vehicle_id);
            if (!$stmt->execute()) {
                throw new Exception("Error updating vehicle: " . $stmt->error);
            }
            $stmt->close();

            $logAction = "Payment";
            $logDetails = "User ID $userId paid $paid_amount for vehicle ID $vehicle_id";
            $stmt = $conn->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("iss", $userId, $logAction, $logDetails);
                $stmt->execute();
                $stmt->close();
            } else {
                echo "Failed to prepare the log SQL statement.";
            }

            // Commit transaction
            $conn->commit();
            echo json_encode(["success" => true, "message" => "Balance updated successfully."]);

        } catch (Exception $e) {
            // Rollback transaction on error
            $conn->rollback();
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        } finally {
            $conn->close();
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid vehicle ID or amount."]);
    }
}
?>