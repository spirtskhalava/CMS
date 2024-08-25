<?php
session_start();
$servername = "sql213.infinityfree.com";
$username = "if0_36250918";
$password = "jE9RlKdVRb";
$dbname = "if0_36250918_calculator";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["location"])) {
    $brand = $_GET["location"];
    $sql = "SELECT from_title FROM data";
    $result = $conn->query($sql);
    $models = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $models[] = $row['from_title'];
        }
    }
    $options = array_map(function($value) use ($brand) {
    return [
        'value' => $value,
        'selected' => ($value == $brand)
    ];
    }, $models);
    echo json_encode($options);
}

$conn->close();
?>