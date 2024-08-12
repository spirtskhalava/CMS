<?php
session_start();
include "../db_conn.php";
$search_term = $conn->real_escape_string($_GET['search']);

$sql = "
    SELECT *
    FROM vehicles
    WHERE vin='$search_term'
";

$result = $conn->query($sql);

$dealers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dealers[] = $row;
    }
}
$conn->close();
if (isset($_SESSION["username"]) && isset($_SESSION["id"])) { ?>
<!DOCTYPE html>
<html> 
<head>
    <title>Admin Panel</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <!-- <link rel="shortcut icon" href="favicon.ico">  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.css"> 
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
    <style>

.swiper-slide-img {
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  object-fit: cover; /* Add this property */
  transition: transform 0.3s ease-in-out;
}
</style>

</head> 

<body class="app">   	
    <header class="app-header fixed-top">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
                        <?php include "../add_balance.php";?>
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		
		            <div class="app-utilities col-auto">
	
			            
                    <?php
                   include "../balance.php";
                   ?>
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <?php include "../sidebar.php"; ?>
				<?php include "../footer.php"; ?>
			    
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <!-- Search Result Page -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Search Results</h1>
      <p>Results for VIN: <strong><?php echo $_GET['search']; ?></strong></p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <!-- Image Slider -->
      <div class="swiper-container">
  <div class="swiper-wrapper">
        <?php foreach (explode(',', $dealers[0]["image_paths"]) as $path): ?>
            <div class="swiper-slide">
                <img src="<?= $path ?>" alt="Vehicle Image" class="swiper-slide">
            </div>
        <?php endforeach; ?>
    </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  <div class="swiper-pagination"></div>
</div>
    </div>
    <div class="col-md-6">
      <h2><?php echo $dealers[0]["year"]." ". $dealers[0]["make"] . " " . $dealers[0]["model"]; ?></h2>
      <span>Price: <strong>$<?php echo $dealers[0]["price"]; ?></strong></span><br>
      <span>Auction: <?php echo $dealers[0]["auction"]; ?></span><br>
      <span>Lot: <?php echo $dealers[0]["lot"]; ?></span><br>
    </div>
        <div class="col-md-12">
      <h3>Features</h3>
      <ul class="list-unstyled">
        <li><i class="fas fa-check-circle"></i> Heated Seats</li>
        <li><i class="fas fa-check-circle"></i> Navigation System</li>
        <li><i class="fas fa-check-circle"></i> Rearview Camera</li>
        <li><i class="fas fa-check-circle"></i> Bluetooth Connectivity</li>
      </ul>
    </div>
  </div>
</div>
	    </div><!--//app-content-->
	    
	    
    </div><!--//app-wrapper-->    	

    <!-- Javascript -->          
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.8.4/swiper-bundle.min.js"></script>


<!-- Initialize Swiper -->

<script>

  var swiper = new Swiper('.swiper-container', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
    },
  });
</script>

</body>
</html>
<?php } else {header("Location: ../index.php");} ?>