<?php
include "db_conn.php";
?>
 <style>
        .input-group .btn {
            border: 0;
        }
        .input-group .btn i {
            font-size: 1rem;
        }
    </style>
<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
   <ul class="app-menu list-unstyled accordion" id="menu-accordion">
   <li class="nav-item">
    <div class="container mt-4 mb-2">
        <form id="searchForm" action="search_results.php" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" id="searchInput" name="search" placeholder="Enter VIN">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
      </li>
      <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link active" href="admin.php">
            <span class="nav-icon">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
                  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
               </svg>
            </span>
            <span class="nav-link-text">Dashboard</span>
         </a>
         <!--//nav-link-->
      </li>
     <?php if($_SESSION['role']=='admin') {?> 
      <!--//nav-item-->
      <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link" href="user.php">
            <span class="nav-icon">
               <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                  <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                  <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
               </svg>
            </span>
            <span class="nav-link-text">Users</span>
         </a>
         <!--//nav-link-->
      </li>
      <!--//nav-item-->
      <?php }?> 
      <?php
        function getRequestCount($mycon) {
    $sql = "SELECT COUNT(id) FROM balance_requests WHERE status = 'pending'";  

    $result = mysqli_query($mycon, $sql);

    if (!$result) {
        die('Query failed: ' . mysqli_error($mycon));
    }

    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    if ($row) {
        echo $row[0];
    } else {
        echo "No results found.";
    }
}

          ?>    
       <?php if($_SESSION['role']=='admin') {?>    
       <!--//nav-item-->
       <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link" href="check_balance.php">
         <span class="nav-icon">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
               </svg>
            </span>
            <span class="nav-link-text">Balance Request <?php getRequestCount($conn); ?></span>
         </a>
         <!--//nav-link-->
      </li>
      <?php } ?> 

      <?php if($_SESSION['role']=='admin') {?>  
      <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link" href="fines.php">
         <span class="nav-icon">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
               </svg>
            </span>
            <span class="nav-link-text">Fines</span>
         </a>
         <!--//nav-link-->
      </li>

      <?php } ?> 
      <!--//nav-item-->
      <li class="nav-item has-submenu">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-1" aria-expanded="false" aria-controls="submenu-1">
            <span class="nav-icon">
               <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-files" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 1a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4z"/>
                  <path d="M6 0h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H6a1 1 0 0 0-1 1H4a2 2 0 0 1 2-2z"/>
               </svg>
            </span>
            <span class="nav-link-text">All Orders</span>
            <span class="submenu-arrow">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
               </svg>
            </span>
            <!--//submenu-arrow-->
         </a>
         <?php
        function getCount($status, $mycon) {
    $userId = intval($_SESSION['id']); // Ensure the ID is an integer

    // Check if $status is an integer or a string and prepare the SQL accordingly
    if (is_int($status)) {
      if($_SESSION['role']=='admin'){
         $sql = "SELECT COUNT(id) FROM vehicles WHERE status = $status";
      }else{
         $sql = "SELECT COUNT(id) FROM vehicles WHERE status = $status AND user_id = $userId";
     }
    } else {
        // Assuming $status is a string, so we escape it properly
        $status = mysqli_real_escape_string($mycon, $status);
        if($_SESSION['role']=='admin'){
         $sql = "SELECT COUNT(id) FROM vehicles WHERE status = '$status'";
      }else{
         $sql = "SELECT COUNT(id) FROM vehicles WHERE status = '$status' AND user_id = $userId";
     }
    }

    $result = mysqli_query($mycon, $sql);

    if (!$result) {
        die('Query failed: ' . mysqli_error($mycon));
    }

    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    if ($row) {
        echo $row[0];
    } else {
        echo "No results found.";
    }
}
$us_states = array(
	'AL'=>'ALABAMA',
	'AK'=>'ALASKA',
	'AS'=>'AMERICAN SAMOA',
	'AZ'=>'ARIZONA',
	'AR'=>'ARKANSAS',
	'CA'=>'CALIFORNIA',
	'CO'=>'COLORADO',
	'CT'=>'CONNECTICUT',
	'DE'=>'DELAWARE',
	'DC'=>'DISTRICT OF COLUMBIA',
	'FM'=>'FEDERATED STATES OF MICRONESIA',
	'FL'=>'FLORIDA',
	'GA'=>'GEORGIA',
	'GU'=>'GUAM GU',
	'HI'=>'HAWAII',
	'ID'=>'IDAHO',
	'IL'=>'ILLINOIS',
	'IN'=>'INDIANA',
	'IA'=>'IOWA',
	'KS'=>'KANSAS',
	'KY'=>'KENTUCKY',
	'LA'=>'LOUISIANA',
	'ME'=>'MAINE',
	'MH'=>'MARSHALL ISLANDS',
	'MD'=>'MARYLAND',
	'MA'=>'MASSACHUSETTS',
	'MI'=>'MICHIGAN',
	'MN'=>'MINNESOTA',
	'MS'=>'MISSISSIPPI',
	'MO'=>'MISSOURI',
	'MT'=>'MONTANA',
	'NE'=>'NEBRASKA',
	'NV'=>'NEVADA',
	'NH'=>'NEW HAMPSHIRE',
	'NJ'=>'NEW JERSEY',
	'NM'=>'NEW MEXICO',
	'NY'=>'NEW YORK',
	'NC'=>'NORTH CAROLINA',
	'ND'=>'NORTH DAKOTA',
	'MP'=>'NORTHERN MARIANA ISLANDS',
	'OH'=>'OHIO',
	'OK'=>'OKLAHOMA',
	'OR'=>'OREGON',
	'PW'=>'PALAU',
	'PA'=>'PENNSYLVANIA',
	'PR'=>'PUERTO RICO',
	'RI'=>'RHODE ISLAND',
	'SC'=>'SOUTH CAROLINA',
	'SD'=>'SOUTH DAKOTA',
	'TN'=>'TENNESSEE',
	'TX'=>'TEXAS',
	'UT'=>'UTAH',
	'VT'=>'VERMONT',
	'VI'=>'VIRGIN ISLANDS',
	'VA'=>'VIRGINIA',
	'WA'=>'WASHINGTON',
	'WV'=>'WEST VIRGINIA',
	'WI'=>'WISCONSIN',
	'WY'=>'WYOMING',
	'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
	'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
	'AP'=>'ARMED FORCES PACIFIC'
);

          ?>                       
         <!--//nav-link-->
         <div id="submenu-1" class="collapse submenu submenu-1 show" data-bs-parent="#menu-accordion">
            <ul class="submenu-list list-unstyled">
               <li class="submenu-item"><a class="submenu-link" href="pending.php">Pending <?php getCount("Pending", $conn); ?></a></li>
               <li class="submenu-item"><a class="submenu-link" href="new.php">New Orders <?php getCount("New", $conn); ?></a></li>
               <li class="submenu-item"><a class="submenu-link" href="dispached.php">Loading <?php getCount("Loading", $conn); ?></a></li>
               <li class="submenu-item"><a class="submenu-link" href="arrived.php">Arrived <?php getCount("Arrived", $conn); ?></a></li>
               <?php foreach ($us_states as $value) { 
               echo "<li class='submenu-item'><a class='submenu-link' href='orders.php?state=".strtolower($value)."'>".$value."</a></li>";
               } ?>
            </ul>
         </div>
      </li>
      <!--//nav-item-->			
      <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link" href="add-vehicle.php">
            <span class="nav-icon">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
               </svg>
            </span>
            <span class="nav-link-text">Add Vehicle</span>
         </a>
         <!--//nav-link-->
      </li>
      <!--//nav-item-->
      <!--//nav-item-->		
      <?php if($_SESSION['role']=='admin') {?>  	
      <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link" href="add-buyer.php">
            <span class="nav-icon">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
               </svg>
            </span>
            <span class="nav-link-text">Add Buyer Code</span>
         </a>
         <!--//nav-link-->
      </li>
      <!--//nav-item-->
      <?php } ?> 

      <?php if($_SESSION['role']=='admin') {?> 
      <!--//nav-item-->			
      <li class="nav-item">
         <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
         <a class="nav-link" href="buyer.php">
            <span class="nav-icon">
               <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
                  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
               </svg>
            </span>
            <span class="nav-link-text">Buyers</span>
         </a>
         <!--//nav-link-->
      </li>
      <?php } ?> 
      <!--//nav-item-->
   </ul>
   <!--//app-menu-->
</nav>
<!--//app-nav-->
