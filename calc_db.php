<?php  

$sname = "sql213.infinityfree.com";
$uname = "if0_36250918";
$password = "jE9RlKdVRb";

$db_name = "if0_36250918_calculator";

$res = mysqli_connect($sname, $uname, $password, $db_name);

if (!$res) {
	echo "Connection Failed!";
	exit();
}

?>