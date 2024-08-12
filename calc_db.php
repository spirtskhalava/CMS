<?php  

$sname = "localhost";
$uname = "root";
$password = "";

$db_name = "data";

$res = mysqli_connect($sname, $uname, $password, $db_name);

if (!$res) {
	echo "Connection Failed!";
	exit();
}

?>