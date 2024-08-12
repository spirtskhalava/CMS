<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$param = $_GET['param'] ?? '';
    $sql = "SELECT price FROM `datas` WHERE `from_title` = '$param'";
    $result = $conn->query($sql);
    
    $models = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['price'];
        }
    }

    // $price = $row['price'];
    // $userId = intval($_SESSION['id']);
    // $stmt1 = $conn->prepare("UPDATE users SET nbalance = ? WHERE id = ?");
    // if ($stmt1) {
    // // Bind parameters and execute the statement
    // $stmt1->bind_param("di", $price, $userId); // "d" for double, "i" for integer
    // $stmt1->execute();
    // $stmt1->close();  
    // } else {
    // echo "Failed to prepare the SQL statement.";
    // }

    $conn->close();
?>
