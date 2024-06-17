<?php
// Include database connection
require_once "db_conn.php";
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve data from form
    $dropdownSelect = isset($_POST['dropdownSelect']) ? $_POST['dropdownSelect'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $saddress = isset($_POST['saddress']) ? $_POST['saddress'] : '';
    $zip = isset($_POST['zip']) ? $_POST['zip'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $unique_id = isset($_POST['unique_id']) ? $_POST['unique_id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '' ;

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO consignee (status, firstname, lastname, country, city, address, saddress, zip, phone, email, personal_id, type, comment, user_id, company) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        // Print detailed error message
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    $stmt->bind_param("ssssssssissssss", $dropdownSelect, $fname, $lname, $country, $city, $address, $saddress, $zip, $phone, $email, $unique_id, $type, $comment, $user_id, $company);

    if ($stmt->execute()) {
        // Get the ID of the last inserted row
        $lastInsertedId = $conn->insert_id;

        // Fetch the last inserted row from the database
        $result = $conn->query("SELECT * FROM consignee WHERE id = $lastInsertedId");
        if ($result && $row = $result->fetch_assoc()) {
            // Return the last inserted row as JSON
            echo json_encode($row);
        } else {
            echo "No data found.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
