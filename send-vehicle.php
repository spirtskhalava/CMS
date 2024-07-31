<?php
require_once "db_conn.php";
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

    $stmt = $conn->prepare("INSERT INTO vehicles (make, model, auction, branch, dest, vin, year, lot, price, dt, buyer_id, consigne_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssssssiiisiiis", $make, $model, $auction, $branch, $dest, $vin, $year, $lot, $price, $dt, $buyer, $consignee, $user, "Pending");

    if ($stmt->execute()) {
        header("Location: pages/add-vehicle.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>
