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
      <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
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
                              <div class="table-responsive">
                                 <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                       <tr>
                                          <th class="cell">Make</th>
                                          <th class="cell">Model</th>
                                          <th class="cell">Vin</th>
                                          <th class="cell">Branch</th>
                                          <th class="cell">Auction</th>
                                          <th class="cell">Lot</th>
                                          <th class="cell">Price</th>
                                          <th class="cell">Date</th>
                                          <th class="cell">Status</th>
                                          <th class="cell">Booking ID</th>
                                          <th class="cell">Container ID</th>
                                          <th class="cell">Personal ID</th>
                                          <th class="cell">First Name</th>
                                          <th class="cell">Last Name</th>
                                          <th class="cell">Debt</th>
                                          <th class="cell"></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $sql = "SELECT * FROM vehicles where status='Arrived'";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_array($result)) { ?>	
                                       <tr>
                                          <td class="cell"><span class="truncate"><?php echo $row["make"]; ?></span></td>
                                          <td class="cell"><?php echo $row["model"]; ?></td>
                                          <td class="cell"><span class="note"><?php echo $row["vin"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["branch"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["auction"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["lot"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["price"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["dt"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["status"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["booking_id"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["container_id"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["personal_id"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["first_name"]; ?></span></td>
                                          <td class="cell"><span class="note"><?php echo $row["last_name"]; ?></span></td>
                                          <td class="cell">
                                             <input type="hidden" id="vehicleID" value="<?php echo $row["id"]; ?>">  <button class="icon-button" id="icon-button">
                                             <i class="fas fa-info-circle"></i>
                                             </button>
                                             <span class="note">
                                                <?php echo $row["debt"]; ?><br><input type="text" id="dept"><br>
                                                <button type="button" class="btn btn-primary" id="pay">
                                                   pay
                                             </span>
                                             <input type="hidden" id="vehicleid" name="vehicleid" value="<?=$row['id'] ?>">
                                          </td>
                                          <td class="cell"><a class="btn-sm app-btn-secondary edit" data-id="<?php echo $row["id"]; ?>" href="edit-vehicle.php?id=<?=$row["id"]; ?>">Edit</a><a class="btn-sm app-btn-secondary delete" data-id="<?php echo $row["id"]; ?>" href="delete_vehicle.php?id=<?=$row["id"]; ?>">Delete</a></td>
                                       </tr>
                                       <?php }
                                          ?>
                                    </tbody>
                                 </table>
                              </div>
                              <!--//table-responsive-->
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
      <!-- Javascript -->          
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="assets/plugins/popper.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  
      <!-- Page Specific JS -->
      <script src="assets/js/app.js"></script>
      <script>
         if(document.getElementById('pay')){   
         document.getElementById('pay').addEventListener('click', function(event) {
         event.preventDefault();
         var sum = document.getElementById('dept').value;
         var vehicleid=document.getElementById('vehicleid').value;
         fetch('pay.php', {
           method: 'POST',
           headers: {
               'Content-Type': 'application/x-www-form-urlencoded'
           },
           body: new URLSearchParams({
               'id':vehicleid,
               'sum': sum
           })
         })
         .then(response => response.text())
         .then(data => {
         location.reload();
         console.log(data);
         })
         .catch(error => {
          console.log(error);
         });
         });
         
         }
         
         if(document.getElementById('icon-button')){
         document.getElementById('icon-button').addEventListener('click', function(event) {
         event.preventDefault();
         const vehicleID = document.getElementById("vehicleID").value;
         fetch(`get_vehicle_info.php?id=${vehicleID}`)
           .then(response => response.json())
           .then(data => {
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
                       modalTableBody.innerHTML = '<tr><td colspan="2">No data found</td></tr>';
                   }
         
                   const infoModal = new bootstrap.Modal(document.getElementById('infoModal'));
                   infoModal.show();
           })
           .catch(error => {
                 console.error('Error:', error);
           });
         });
         }
      </script>
   </body>
</html>
<?php } else {header("Location: ../index.php");} ?>