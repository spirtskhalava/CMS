<?php
session_start();
include "../db_conn.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $new_discount = isset($_POST['amount']) ? $_POST['amount'] : 0;

    // Check if a discount already exists for the user and get the current discount
    $checkStmt = $conn->prepare("SELECT id, discount FROM discount WHERE user_id = ?");
    if (!$checkStmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    
    $checkStmt->bind_param("i", $user_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    // Bind the result to variables
    $checkStmt->bind_result($discount_id, $current_discount);
    if ($checkStmt->num_rows > 0) {
        // Fetch the result
        $checkStmt->fetch();

        // Discount exists, update it or handle it based on your logic
        // Example: Update if the new discount is different from the current discount
        if ($new_discount != $current_discount) {
            $updateStmt = $conn->prepare("UPDATE discount SET discount = ? WHERE id = ?");
            if (!$updateStmt) {
                die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
            }
            
            $updateStmt->bind_param("ii", $new_discount, $discount_id);
            if ($updateStmt->execute()) {
                header("Location: discount.php");
                exit();
            } else {
                echo "Error: " . $updateStmt->error;
            }
            
            $updateStmt->close();
        } else {
            // If the discount is the same, you might choose to do nothing or show a message
            echo "The discount amount is already set to this value.";
        }
    } else {
        // Discount doesn't exist, insert a new one
        $insertStmt = $conn->prepare("INSERT INTO discount (user_id, discount) VALUES (?, ?)");
        if (!$insertStmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }
        
        $insertStmt->bind_param("ii", $user_id, $new_discount);
        if ($insertStmt->execute()) {
            header("Location: discount.php");
            exit();
        } else {
            echo "Error: " . $insertStmt->error;
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
}
?>