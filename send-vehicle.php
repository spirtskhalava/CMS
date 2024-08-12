<?php
session_start();
require_once "db_conn.php";
require_once "calc_db.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auction = isset($_POST['auction']) ? $_POST['auction'] : '';
    $branch = isset($_POST['branch']) ? $_POST['branch'] : '';
    $dest = isset($_POST['dest']) ? $_POST['dest'] : '';
    $vin = isset($_POST['vin']) ? $_POST['vin'] : '';
    $make = isset($_POST['make']) ? $_POST['make'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $lot = isset($_POST['lot']) ? $_POST['lot'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $dt = isset($_POST['dt']) ? $_POST['dt'] : '';
    $buyer = isset($_POST['buyer']) ? $_POST['buyer'] : '';
    $consignee = isset($_POST['consignee']) ? $_POST['consignee'] : '';
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $nprice = isset($_POST['nprice']) ? $_POST['nprice'] : '';

    // Prepare and execute the first statement
    $stmt = $conn->prepare("INSERT INTO vehicles (make, model, auction, branch, dest, vin, year, lot, price, dt, buyer_id, consigne_id, user_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $status = "Pending"; // Hardcoded status
    $stmt->bind_param("ssssssiiisiiis", $make, $model, $auction, $branch, $dest, $vin, $year, $lot, $price, $dt, $buyer, $consignee, $user, $status);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id;
        $userId = intval($_SESSION['id']);
        $stmt1 = $conn->prepare("UPDATE vehicles SET dept = ? WHERE id = ?");
        if ($stmt1) {
            // Bind parameters and execute the statement
            $stmt1->bind_param("di", $nprice, $$last_id ); // "d" for double, "i" for integer
            $stmt1->execute();
            $stmt1->close();  
        } else {
            echo "Failed to prepare the SQL statement.";
        }
        header("Location: pages/add-vehicle.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>