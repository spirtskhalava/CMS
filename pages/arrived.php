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
      <!-- App CSS -->  
      <link id="theme-style" rel="stylesheet" href="assets/css/portal.css?v=<?php echo time(); ?>">
      <style>
         .icon-button {
         background: #007bff;
         border: none;
         color: white;
         cursor: pointer;
         border-radius: 50%; /* Makes the button round */
         width: 25px; /* Button width */
         height: 25px; /* Button height */
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 1.2rem; /* Icon size */
         padding: 0;
         line-height: 1;
         }
         .icon-button:hover {
         background: #0056b3;
         }
            .small-image {
    width: 50px;
    height: auto;
    cursor: pointer;
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
                           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                              <title>Menu</title>
                              <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                           </svg>
                        </a>
                     </div>
                     <!--//col-->
                     <div class="app-utilities col-auto">
                        <?php
                           include "../balance.php";
                           ?>
                     </div>
                     <!--//app-utilities-->
                  </div>
                  <!--//row-->
               </div>
               <!--//app-header-content-->
            </div>
            <!--//container-fluid-->
         </div>
         <!--//app-header-inner-->
         <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
               <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
               <div class="app-branding">
                  <a class="app-logo" href="/"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
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
            <div class="container-fluid">
               <div class="row g-4 mb-4">
                  <div class="tab-content" id="orders-table-tab-content">
                     <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                           <div class="app-card-body">
                            <form method="GET" class="mb-4">
                                      <div class="input-group">
                                        <input type="text" name="vin_filter" class="form-control" placeholder="Enter VIN code to filter" value="<?php echo isset($_GET['vin_filter']) ? htmlspecialchars($_GET['vin_filter']) : ''; ?>">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                      </div>
                                    </form>
                              <div class="table-responsive">
                                 <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                       <tr>
                                        <th class="cell">Image</th>
                                          <th class="cell">Make</th>
                                            <th class="cell">Model</th>
                                            <th class="cell">Year</th>
                                            <th class="cell">Vin</th>
                                            <th class="cell">Username</th>
                                            <th class="cell">First Name</th>
                                             <th class="cell">Last Name</th>
                                             <th class="cell">Personal Id</th>
                                            <th class="cell">Auction</th>
                                            <th class="cell">Lot</th>
                                            <th class="cell">Date</th>
                                            <th class="cell">Status</th>
                                            <th class="cell">Booking ID</th>
                                            <th class="cell">Container ID</th>
                                            <th class="cell">Branch</th>
                                            <th class="cell">Port of Load</th>
                                            <th class="cell">Paid</th>
                                            <th class="cell">Debt</th>
                                          <th class="cell"></th>
                                          <th class="cell">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                       function getUsernameById($userId, $conn) {
    // Ensure $userId is an integer
    $userId = intval($userId);
    
    // Prepare the SQL statement
  $sql = "
    SELECT users.username 
    FROM users 
    INNER JOIN vehicles ON users.id = vehicles.user_id 
    WHERE vehicles.user_id = ?
";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the userId parameter to the SQL statement
        $stmt->bind_param("i", $userId);
        
        // Execute the statement
        $stmt->execute();
        
        // Bind the result variable
        $stmt->bind_result($username);
        
        // Fetch the result
        if ($stmt->fetch()) {
            // Close the statement
            $stmt->close();
            
            // Return the username
            return $username;
        } else {
            // Close the statement
            $stmt->close();
            
            // Return null if no username found
            return null;
        }
    } else {
        // Return null if there was an error preparing the statement
        return null;
    }
 }
                                           $userId = intval($_SESSION['id']);
//                                           if($_SESSION['role']=='admin' || $_SESSION['role']=='accountant' ){
//                                              $sql = "SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname FROM vehicles LEFT JOIN consignee ON vehicles.consigne_id = consignee.id where vehicles.status='Pending'";
//                                           }else{
//                                              $sql = "SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname FROM vehicles LEFT JOIN consignee ON vehicles.consigne_id = consignee.id where vehicles.status='Pending' AND vehicles.user_id = '$userId'";
//                                          }
//                                           $result = mysqli_query($conn, $sql);
// Pagination logic
                                                    $results_per_page = 10; // Number of results per page
                                                    $userId = intval($_SESSION['id']);
                                                    
                                                    // Filter by VIN code
                                                    $vin_filter = isset($_GET['vin_filter']) ? $_GET['vin_filter'] : '';

                                                    // Determine the total number of results
                                                    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'accountant') {
                                                        $total_sql = "SELECT COUNT(*) FROM vehicles WHERE vin LIKE '%" . mysqli_real_escape_string($conn, $vin_filter) . "%'";
                                                    } else {
                                                        $total_sql = "SELECT COUNT(*) FROM vehicles WHERE user_id = '$userId' AND vin LIKE '%" . mysqli_real_escape_string($conn, $vin_filter) . "%'";
                                                    }

                                                    $total_result = mysqli_query($conn, $total_sql);
                                                    $total_rows = mysqli_fetch_array($total_result)[0];
                                                    $total_pages = ceil($total_rows / $results_per_page);

                                                    // Determine the current page
                                                    $current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                                    if ($current_page < 1) $current_page = 1;
                                                    if ($current_page > $total_pages) $current_page = $total_pages;

                                                    $offset = ($current_page - 1) * $results_per_page;

                                                    // Fetch results for the current page
                                                    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'accountant') {
                                                        $sql = "SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname,consignee.personal_id AS consignee_personal
                                                                FROM vehicles 
                                                                LEFT JOIN consignee ON vehicles.consigne_id = consignee.id 
                                                                WHERE vehicles.status='Arrived' AND vehicles.vin LIKE '%" . mysqli_real_escape_string($conn, $vin_filter) . "%'
                                                                LIMIT $offset, $results_per_page";
                                                    } else {
                                                        $sql = "SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname, consignee.personal_id AS consignee_personal 
                                                                FROM vehicles 
                                                                LEFT JOIN consignee ON vehicles.consigne_id = consignee.id 
                                                                WHERE vehicles.user_id = '$userId' AND vehicles.status='Arrived' AND vehicles.vin LIKE '%" . mysqli_real_escape_string($conn, $vin_filter) . "%'
                                                                LIMIT $offset, $results_per_page";
                                                    }

                                                    $result = mysqli_query($conn, $sql); 
                                          while ($row = mysqli_fetch_array($result)) { ?>	
                                       <tr>
                                       <td class="cell">
                           <img src="<?php echo $row['image_paths']; ?>" class="img-thumbnail small-image" data-bs-toggle="modal" data-bs-target="#imageModal" data-full-image="<?php echo $row['image_paths']; ?>" alt="Vehicle Image">
                         </td>
                                          <td class="cell"><span class="truncate"><?php echo $row["make"]; ?></span></td>
                                          <td class="cell"><?php echo $row["model"]; ?></td>
                                          <td class="cell"><?php echo $row["year"]; ?></td>
                                          <td class="cell"><span class="note"><?php echo $row["vin"]; ?></span></td>
                                          <td class="cell">
                                                        <span class="note"><?php $username = getUsernameById(intval($row["user_id"]), $conn); echo $username; ?></span>
                                                    </td>
                                          <td class="cell"><span class="note"><?php echo $row["consignee_name"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["consignee_lname"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["consignee_personal"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["auction"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["lot"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["dt"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["status"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["booking_id"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["container_id"]; ?></span></td>
                                           <td class="cell"><span class="note"><?php echo $row["branch"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["container_name"]; ?></span></td>
                                          <td class="cell">
                                          <span class="note"> <?php echo $row["debt"]==0 ? "Yes" : "No"; ?> </span>
                                          </td>
                                          <td class="cell">
                            <?php echo $_SESSION["role"]=='admin' || $_SESSION['role']=='accountant' ? $row["debt"] : ''; ?>
                            <?php if($_SESSION['role']!=='admin' && $_SESSION['role']!=='accountant' && $row["debt"]>0){?>
                              <input type="hidden" data-id="<?php echo $row["id"]; ?>" value="<?php echo $row["id"]; ?>">  
                              <span class="note" style="font-size:16px;"> <?php echo $row["debt"]; ?> <br>
                                <input type="text" class="dept">
                                <button type="button" class="btn btn-primary pay">pay </button>
                                <button class="icon-button" id="icon-button">
                                <i class="fas fa-info-circle"></i>
                              </button>
                                </span>
                              <input type="hidden" name="vehicleid" data-vehicleid="<?=$row['id'] ?>">
                             <?php }?> 
                            </td>
                                          <td class="cell">
                                           <?php if($_SESSION['role']=='admin'){?>
                              <a class="btn-sm app-btn-secondary edit" data-id="<?php echo $row["id"]; ?>" href="edit-vehicle.php?id=<?=$row["id"]; ?>">Edit </a>
                              <a class="btn-sm app-btn-secondary delete" data-id="<?php echo $row["id"]; ?>" href="delete_vehicle.php?id=<?=$row["id"]; ?>">Delete </a>
                               <?php }?>
                                <td class="cell">
                             <a class="btn-sm app-btn-secondary" href="car.php?id=<?=$row["id"]; ?>">View</a>
                            </td>
                                       </tr>
                                       <?php }
                                          ?>
                                    </tbody>
                                 </table>
                              </div>
                              <!--//table-responsive-->
                                 <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center mt-4">
                                            <li class="page-item <?php if ($current_page == 1) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo ($current_page - 1); ?>&vin_filter=<?php echo urlencode($vin_filter); ?>" tabindex="-1">Previous</a>
                                            </li>
                                            <?php for ($page = 1; $page <= $total_pages; $page++) { ?>
                                                <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
                                                    <a class="page-link" href="?page=<?php echo $page; ?>&vin_filter=<?php echo urlencode($vin_filter); ?>"><?php echo $page; ?></a>
                                                </li>
                                            <?php } ?>
                                            <li class="page-item <?php if ($current_page == $total_pages) echo 'disabled'; ?>">
                                                <a class="page-link" href="?page=<?php echo ($current_page + 1); ?>&vin_filter=<?php echo urlencode($vin_filter); ?>">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                           </div>
                           <!--//app-card-body-->		
                        </div>
                        <!--//app-card-->
                     </div>
                     <!--//tab-pane-->
                  </div>
               </div>
               <!--//container-fluid-->
            </div>
            <!--//app-content-->
         </div>
         <!--//app-wrapper-->    	
      </div>
      <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="infoModalLabel">Vehicle Details</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <table class="table">
      <thead>
      <tr>
      <th>Amount</th>
      <th>Comment</th>
      </tr>
      </thead>
      <tbody id="modalTableBody">
      <!-- Data will be populated here -->
      </tbody>
      </table>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
      </div>
     <!-- Modal for Enlarged Image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="enlargedImage" src="" class="img-fluid" alt="Enlarged Image">
            </div>
        </div>
    </div>
</div>
      
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="assets/plugins/popper.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
      <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
      <script>
           if (document.getElementsByClassName('pay')) {
            const payButtons = document.getElementsByClassName('pay');
            Array.from(payButtons).forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const deptInput = button.previousElementSibling.previousElementSibling.parentNode.previousElementSibling.dataset.id;
                    const vehicleid = button.previousElementSibling.value;
                    fetch('pay.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({
                            'id': vehicleid,
                            'sum': deptInput
                        })
                    }).then(response => response.text()).then(data => {
                        location.reload();
                        console.log(data);
                    }).catch(error => {
                        console.log(error);
                    });
                });
            });
        }
        if (document.getElementsByClassName('icon-button')) {
            const iconButtons = document.getElementsByClassName('icon-button');
            Array.from(iconButtons).forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    console.log("button.previousElementSibling.value", button.previousElementSibling.previousElementSibling.parentNode.previousElementSibling.dataset.id);
                    fetch(`get_vehicle_info.php?id=${button.previousElementSibling.previousElementSibling.parentNode.previousElementSibling.dataset.id}`).then(response => response.json()).then(data => {
                        const modalTableBody = document.getElementById('modalTableBody');
                        modalTableBody.innerHTML = ''; // Clear previous content
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(fine => {
                                modalTableBody.innerHTML += `
                                    <tr>
                                        <td>${fine.debt}</td>
                                        <td>${fine.comment}</td>
                                    </tr>
                                `;
                            });
                        } else {
                            modalTableBody.innerHTML = '<tr><td colspan="2"> No data found </td></tr>';
                        }
                        const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
                        infoModal.show();
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        }
        // Add event listener for image click
        document.querySelectorAll('.small-image').forEach(image => {
            image.addEventListener('click', function() {
                const fullImageUrl = image.getAttribute('data-full-image');
                const enlargedImage = document.getElementById('enlargedImage');
                enlargedImage.src = fullImageUrl; // Set the full image URL to the modal image
            });
        });
      </script>
   </body>
</html>
<?php } else {header("Location: ../index.php");} ?>