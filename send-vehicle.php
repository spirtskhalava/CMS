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
    $booking_id = isset($_POST['booking_id']) ? $_POST['booking_id'] : '';
    $container_id = isset($_POST['container_id']) ? $_POST['container_id'] : '';
    $personal_id = isset($_POST['personal_id']) ? $_POST['personal_id'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';

    
    // Prepare and execute the first statement
    $stmt = $conn->prepare("INSERT INTO vehicles (make, model, auction, branch, dest, vin, year, lot, price, dt, buyer_id, consigne_id, user_id, status, booking_id, container_id,personal_id,first_name,last_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $status = "Pending";
    $stmt->bind_param("ssssssiiisiiisiisss", $make, $model, $auction, $branch, $dest, $vin, $year, $lot, $price, $dt, $buyer, $consignee, $user, $status,$booking_id,$container_id,$personal_id,$first_name,$last_name);

    if ($stmt->execute()) {
        $sql = "SELECT from_title, price FROM datas WHERE from_title = ?";
        $stmt2 = $res->prepare($sql);
        $stmt2->bind_param("s", $branch);
        $stmt2->execute();
        $result = $stmt2->get_result();
        $request = $result->fetch_assoc();


        $last_id = $conn->insert_id;
        $userId = intval($_SESSION['id']);
        $vehicleId = intval($vehicleId); // Make sure to have $vehicleId properly defined

        $stmt1 = $conn->prepare("UPDATE vehicles SET debt = ? WHERE id = ?");
        if ($stmt1) {
            $stmt1->bind_param("di", $request['price'], $last_id); // 'd' for double, 'i' for integer
            if ($stmt1->execute()) {
                echo "Update successful.";
            } else {
                echo "Error executing update: " . $stmt1->error;
            }
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