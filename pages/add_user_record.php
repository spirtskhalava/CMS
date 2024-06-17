<?php
require_once "../db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $sql = "INSERT INTO users (role,username, password,name) values ( ?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $role,$username, $password, $name);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();

?>