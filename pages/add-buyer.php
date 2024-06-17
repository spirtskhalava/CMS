<?php
   session_start();
   include "../db_conn.php";
   if (isset($_SESSION["username"]) && isset($_SESSION["id"])) { ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Admin Panel</title>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
      <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
      <!-- <link rel="shortcut icon" href="favicon.ico">  -->
      <!-- FontAwesome JS-->
      <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css" rel="stylesheet">
      <!-- App CSS -->  
      <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
   </head>
   <body class="app">
      <header class="app-header fixed-top">
      <?php include "../header.php"; ?> 
         <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
               <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
               <div class="app-branding">
                  <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
               </div>
               <!--//app-branding-->  
               <?php include "../sidebar.php"; ?>
               <?php include "../footer.php"; ?>
            </div>
            <!--//sidepanel-inner-->
         </div>
         <!--//app-sidepanel-->
      </header>
      <!--//app-header-->
      <div class="app-wrapper">
      <div class="app-content pt-3 p-md-3 p-lg-4">
         <div class="container-xl">
            <div class="row g-4 mb-4">
			<h2 class="mt-5">Add Form</h2>
        <form action="../send-buyer.php" method="post">
            <div class="mb-3">
            <select class="form-select" name="user">
            <option value="">Select User</option>
            <?php
            $sql = "SELECT id, username FROM users";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row["id"] . '">' . $row["username"] . '</option>';
               }
            }
            ?> 
          </select>
            </div>
            <div class="mb-3">
            <select class="form-select" name="auction" aria-label="Default select example" onchange="fetchAuction()">
            <option value="">Select Auction</option>
            <option value="Copart">Copart</option>
            <option value="IAAI">IAAI</option>
</select>
            </div>
            <div class="mb-3">
            <input class="form-control" name="code" type="text" placeholder="Code" aria-label="default input example">
            </div>

      
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
            <!--//container-fluid-->
         </div>
         <!--//app-content-->
      </div>
      <!--//app-wrapper-->    					
      <!-- Javascript -->          
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="assets/plugins/popper.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
      <!-- Page Specific JS -->
      <script src="assets/js/app.js"></script> 
   </body>
</html>
<?php } else {header("Location: ../index.php");} ?>
