
<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   
      	if ($_SESSION['role'] == 'admin'){
			header("Location: pages/admin.php");
      	 }
		 else if ($_SESSION['role'] == 'dealer'){ 
			header("Location: pages/admin.php");
      	} 
		  else if ($_SESSION['role'] == 'accountant'){ 
			header("Location: pages/admin.php");	
		}
 }
else{
	header("Location:index.php");
} ?>
