<?php
session_start();
require_once "db_conn.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$toPay = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auction = isset($_POST['auction']) ? $_POST['auction'] : '';
    $branch = isset($_POST['branch']) ? $_POST['branch'] : '';
    $dest = isset($_POST['dest']) ? $_POST['dest'] : '';
    $vin = isset($_POST['vin']) ? $_POST['vin'] : '';
    $make = isset($_POST['make']) ? $_POST['make'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $status = "Pending";
    $year = isset($_POST['year']) ? $_POST['year'] : '';
    $lot = isset($_POST['lot']) ? $_POST['lot'] : '';
    $dt = isset($_POST['dt']) ? $_POST['dt'] : '';
    $buyer = isset($_POST['buyer']) ? $_POST['buyer'] : '';
    $consignee = isset($_POST['consignee']) ? $_POST['consignee'] : '';
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $container_id = isset($_POST['container_id']) ? $_POST['container_id'] : '';
    $personal_id = isset($_POST['personal_id']) ? $_POST['personal_id'] : '';
    $container_name = isset($_POST['container_name']) ? $_POST['container_name'] : '';
    $insurance = isset($_POST['insurance']) ? $_POST['insurance'] : '';
    // Check for duplicates
    $checkDuplicateSql = "SELECT id FROM vehicles WHERE vin = ? OR lot = ?";
    $checkStmt = $conn->prepare($checkDuplicateSql);
    $checkStmt->bind_param("si", $vin, $lot);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Duplicate VIN code or lot number.";
        $checkStmt->close();
        $conn->close();
        exit();
    }

    $checkStmt->close();

    // Fetch price from data and containers tables
    $totalPrice = 0;
    
    // Join data and containers tables to get the prices
    $priceQuery = "
    SELECT d.price AS data_price, c.price AS container_price 
    FROM data d 
    INNER JOIN containers c ON d.destination_id = c.id 
    WHERE d.from_title = ?
";

$priceStmt = $conn->prepare($priceQuery);
if (!$priceStmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$priceStmt->bind_param("s", $branch);
$priceStmt->execute();

// Fetch the result directly
$result = $priceStmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $dataPrice = $row['data_price'];
    $containerPrice = $row['container_price'];
    $toPay = $dataPrice + $containerPrice;
} else {
    $toPay = 0;
}



$priceStmt->close();
    // Insert vehicle data
    $stmt = $conn->prepare("INSERT INTO vehicles (make, model, auction, branch, dest, vin, year, lot, price, dt, buyer_id, consigne_id, user_id, status, container_id, container_name, insurance) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssssssiiisiiisiss", $make, $model, $auction, $branch, $dest, $vin, $year, $lot, $price, $dt, $buyer, $consignee, $user, $status, $container_id, $container_name, $insurance);

    if ($stmt->execute()) {
        // Calculate toPay based on price and insurance
        if($_POST['insurance']!=='No'){
          if ($price < 4000) {
            if ($insurance == 'loss') {
                $toPay += 45;
            } else {
                $toPay += 55;
            }
        } elseif ($price >= 4000 && $price < 8000) {
            if ($insurance == 'loss') {
                $toPay += 45;
            } else {
                $toPay += 75;
            }
        } else {
            if ($insurance == 'loss') {
                $totalPrice = $price * (0.75 / 100);
            } else {
                $totalPrice = $price * (1 / 100);
            }
            $toPay=$toPay+$totalPrice;
        }

        }
  

        // Get the last inserted vehicle ID
        $last_id = $conn->insert_id;

        
        

        // Retrieve discount if applicable
        $discountSql = "SELECT user_id, discount FROM discount WHERE user_id = ?";
        $discountStmt = $conn->prepare($discountSql);
        $discountStmt->bind_param("i", $user);
        $discountStmt->execute();
        $result = $discountStmt->get_result(); // Get the result set

        if ($row = $result->fetch_assoc()) {
            $discountPercent = $row['discount']; // Fetch the discount percentage directly
            $toPay =$toPay-$discountPercent; // Subtract the discount amount from toPay
        }

        $discountStmt->close();

        // Ensure toPay does not drop below 0
        $toPay = max($toPay, 0);

        // Update debt in vehicles table
        $sql1 = "UPDATE vehicles SET debt = debt + ? WHERE id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ii", $toPay, $last_id);
        $stmt1->execute();
        $stmt1->close();

        // Insert into fines table
        $comment = "Shipping"; // Set a default comment or get it from POST data if available
        $sql2 = "INSERT INTO fines (vehicle_id, debt, comment) VALUES (?, ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("iis", $last_id, $toPay, $comment);
        $stmt2->execute();
        $stmt2->close();

        // Redirect to add vehicle page
        header("Location: pages/add-vehicle.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>