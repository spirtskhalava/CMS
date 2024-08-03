<?php 
   session_start();
   include "../db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>
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
            <div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Make</th>
												<th class="cell">Model</th>
												<th class="cell">Vin</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
										<?php
                                 $sql = "SELECT * FROM vehicles";
                                 $result = mysqli_query($conn, $sql);
                                 while ($row = mysqli_fetch_array($result)) { ?>	
											<tr>
												<td class="cell"><span class="truncate"><?php echo $row["make"]; ?></span></td>
												<td class="cell"><?php echo $row["model"]; ?></td>
												<td class="cell"><span class="note"><?php echo $row["vin"]; ?></span></td>
												<td class="cell"><a class="btn-sm app-btn-secondary edit" data-id="<?php echo $row["id"]; ?>" href="#">Edit</a></td>
												<td class="cell"><a class="btn-sm app-btn-secondary delete" data-id="<?php echo $row["id"]; ?>" href="#">Delete</a></td>
											</tr>
										<?php }
                                           ?>
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						
			        </div><!--//tab-pane-->
			        
				</div>
            </div>
            <!--//container-fluid-->
         </div>
         <!--//app-content-->
      </div>
      <!--//app-wrapper-->    					
      <!-- Javascript -->          
      <script src="assets/plugins/popper.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
      <!-- Charts JS -->
      <script src="assets/plugins/chart.js/chart.min.js"></script> 
      <script src="assets/js/index-charts.js"></script> 
      <!-- Page Specific JS -->
      <script src="assets/js/app.js"></script> 
   </body>
</html>
<?php }else{
   header("Location: ../login-index.php");
   } ?>
