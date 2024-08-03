<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "data";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch models based on selected brand
if (isset($_GET["location"])) {
    $brand = $_GET["location"];
    $sql = "SELECT * FROM datas WHERE from_title LIKE '%$brand%'";
    $result = $conn->query($sql);
    
    $models = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $models[] = $row['from_title'];
        }
    }
    
    echo json_encode($models);
}

$conn->close();
?>
