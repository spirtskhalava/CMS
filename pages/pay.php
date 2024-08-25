<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vehicle_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $paid_amount = isset($_POST['sum']) ? floatval($_POST['sum']) : 0;
    $user_id = intval($_SESSION['id']);
    $userId = intval($_SESSION['id']);
    $current_debt = 0;

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

            // Update user balance (deducting the paid amount)
            $stmt = $conn->prepare("UPDATE users SET pbalance = pbalance - ? WHERE id = ?");
            $stmt->bind_param("di", $paid_amount, $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Error updating user balance: " . $stmt->error);
            }
            $stmt->close();
 

            // Update vehicle debt
            $stmt = $conn->prepare("UPDATE vehicles SET debt = ? WHERE id = ?");
            $stmt->bind_param("di", $remaining_debt, $vehicle_id);
            if (!$stmt->execute()) {
                throw new Exception("Error updating vehicle: " . $stmt->error);
            }
            $stmt->close();

                    $sql = "
            SELECT users.username, vehicles.vin 
            FROM vehicles 
            INNER JOIN users ON vehicles.user_id = users.id 
            WHERE vehicles.id = ? AND users.id = ?
        ";

        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters and execute the statement
            $stmt->bind_param("ii", $vehicle_id, $userId);
            $stmt->execute();
            
            // Bind result variables
            $stmt->bind_result($username, $vin);
            
            // Fetch the result
            if ($stmt->fetch()) {
                $stmt->close();
                
                // Prepare log details
                $logAction = "Payment";
                $logDetails = "User '$username' paid $paid_amount for vehicle with VIN '$vin'";
                
                // Insert the log entry
                $logStmt = $conn->prepare("INSERT INTO logs (user_id, action, details) VALUES (?, ?, ?)");
                if ($logStmt) {
                    $logStmt->bind_param("iss", $userId, $logAction, $logDetails);
                    $logStmt->execute();
                    $logStmt->close();
                } else {
                    echo "Failed to prepare the log SQL statement.";
                }
            } else {
                $stmt->close();
                echo "No data found for the provided vehicle ID and user ID.";
            }
        } else {
            echo "Failed to prepare the select SQL statement.";
        }

            // Delete any fines associated with the vehicle (if debt is fully paid)
            if ($remaining_debt == 0) {
                $stmt = $conn->prepare("DELETE FROM fines WHERE vehicle_id = ?");
                $stmt->bind_param("i", $vehicle_id);
                if (!$stmt->execute()) {
                    throw new Exception("Error deleting fines: " . $stmt->error);
                }
                $stmt->close();
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