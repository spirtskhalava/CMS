<?php
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "root";
$dbName     = "mydb";

$mysqli = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>