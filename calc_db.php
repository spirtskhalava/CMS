<?php  

$sname = "localhost";
$uname = "root";
$password = "root";

$db_name = "data";

$res = mysqli_connect($sname, $uname, $password, $db_name);

if (!$res) {
	echo "Connection Failed!";
	exit();
}

?>