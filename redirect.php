
<?php 
// this code is for redirecting to different pages if the credentials are correct.
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   
         //admin
      	if ($_SESSION['role'] == 'admin'){
			header("Location: pages/admin.php");
      	 }
		 //teacher
		 else if ($_SESSION['role'] == 'dealer'){ 
			header("Location: pages/admin.php");
      	} 
		//student
		  else if ($_SESSION['role'] == 'accountant'){ 
			header("Location: pages/accountant.php");	
		}
		//parent
		else if ($_SESSION['role'] == 'user'){ 
			header("Location: pages/user.php");
		}
 }
else{
	header("Location:index.php");
} ?>
