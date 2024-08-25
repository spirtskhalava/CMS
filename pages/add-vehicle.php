<?php
   session_start();
   include "../db_conn.php";
   if (isset($_SESSION["username"]) && isset($_SESSION["id"])) { 
      $usernameSessionID = intval($_SESSION['id']); 
      ?>
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
          <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            <form action="../send-vehicle.php" method="post" id="saveForm">
               <div class="mb-3">
                  <select class="form-select" name="auction" id="auctionVal" aria-label="Default select example" onchange="fetchAuction()">
                     <option value="Copart">Copart</option>
                     <option value="IAAI">IAAI</option>
                     <option value="Manheim">Manheim</option>
                     <option value="Cars.com">Cars.com</option>
                  </select>
               </div>
               <div class="mb-3" id="branch-container">
                  <select class="form-select" name="branch" id="result" aria-label="Default select example">
                  </select>
               </div>
               <div class="mb-3">
                  <input class="form-control" type="text" name="dest" id="dest" value="POTI" placeholder="Destionation" aria-label="default input example" disabled>
               </div>
               <div class="input-group mb-3">
                  <input type="text" class="form-control" name="vin" id="vinInput" placeholder="Enter Vin" aria-label="Recipient's username" aria-describedby="button-addon2">
                  <button class="btn btn-primary" type="button" onclick="lookupVIN();">Button</button>
               </div>
               <div class="mb-3">
                  <input class="form-control" type="text" name="make" id="make" placeholder="Make" aria-label="default input example">
               </div>
               <div class="mb-3">
                  <input class="form-control" type="text" name="model" id="model" placeholder="Model" aria-label="default input example">
               </div>
               <div class="mb-3">
                  <input class="form-control" type="number" id="year" name="year" placeholder="Year" aria-label="default input example">
               </div>
               <div class="mb-3">
                  <input class="form-control" type="number" placeholder="Lot" name="lot" aria-label="default input example">
               </div>
               <div class="mb-3">
                  <input class="form-control" type="text" placeholder="Price" name="price" aria-label="default input example">
               </div>
               <div class="mb-3">
                  <input class="form-control" type="date" placeholder="Date" name="dt" aria-label="default input example">
               </div>
               <div class="mb-3">
                <span id="tooltipTrigger" class="text-primary" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="
                <div>
                    <strong>Vehicle Value</strong><br>
                    Up to $4,000: $45.00 (Total Loss), $55.00 (Full Cover)<br>
                    $4,000 - $8,000: $65.00 (Total Loss), $75.00 (Full Cover)<br>
                    Above $8,000: 0.75% (Total Loss), 1% (Full Cover)
                </div>">
                Hover for insurance detail
            </span>
                <select class="form-select" name="insurance" id="insurance" aria-label="Default select example">
                     <option value="No">No</option>         
                     <option value="loss">Total loss</option>
                    <option value="full">Full cover</option>   
                </select>
               </div>   
               <div class="mb-3">
                  <select class="form-select" name="buyer">
                     <option value="">Select Buyer</option>
                     <?php
                        $sql = "SELECT user_id,code, auction, auctionuser FROM buyers  WHERE user_id = '$usernameSessionID'";
                        $result = $conn->query($sql);
                        
                        if (!$result) {
                            echo "Error: " . $conn->error;
                        } else {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["auctionuser"] . '">' . $row["auctionuser"] . ' ('. $row["auction"]. ','.$row["code"].')' . '</option>';
                                }
                            } else {
                                echo "No results found";
                            }
                        }
                          ?> 
                  </select>
               </div>
               <div class="mb-3">
                  <select class="form-select" id="consignee" name="consignee">
                     <option value="">Select Consignee</option>
                     <?php
                        $sql = "SELECT id,company,user_id,firstname,lastname,personal_id FROM consignee WHERE user_id = '$usernameSessionID'";
                        $result = $conn->query($sql);
                        if (!$result) {
                            echo "Error: " . $conn->error;
                        } else {
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if (!empty($row["company"])) {
                                        echo '<option value="' . $row["id"] . '">' . $row["company"] . '('.$row["personal_id"].')'  . '</option>';
                                    }else{
                                       echo '<option value="' . $row["id"] . '">' . $row["firstname"] . ' '.$row["lastname"] . '('.$row["personal_id"].')</option>';
                                    }
                                }
                            } else {
                                echo "No results found";
                            }
                        }
                        ?>
                     <option value="add">Add Consignee</option>
                  </select>
               </div>
               <input type="hidden" name="user" value="<?php echo $_SESSION['id']; ?>">
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Modal Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-md-12">
                              <!-- First field -->
                              <div class="mb-3">
                                 <select id="dropdownSelect" class="form-select">
                                    <option value="company">Enterprise</option>
                                    <option value="private">Private</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <!-- First field -->
                              <div class="mb-3">
                                 <input type="text" class="form-control" placeholder="Enterprise" id="company">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- First field -->
                              <div class="mb-3">
                                 <input type="text" class="form-control private_use" id="fname" placeholder="Firstname" style="display:none;">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- First field -->
                              <div class="mb-3">
                                 <input type="text" class="form-control private_use" id="lname" placeholder="Lastname" style="display:none;">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- First field -->
                              <div class="mb-3">
                                 <select name="country" id="country" class="form-select">
                                 <?php
                                    $sql = "SELECT * FROM countries";
                                    $result = $conn->query($sql);
                                    
                                    if ($result->num_rows > 0) {
                                        // Output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row["country_code"] . "'>" . $row["country_name"] . "</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    $conn->close();
                                    ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- Second field -->
                              <div class="mb-3">
                                 <input type="text" placeholder="City" id="city" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- First field -->
                              <div class="mb-3">
                                 <input type="text" placeholder="Address" id="address" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- Second field -->
                              <div class="mb-3">
                                 <input type="text" placeholder="Address second line" id="saddress" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- First field -->
                              <div class="mb-3">
                                 <input type="text" placeholder="ZIP" id="zip" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- Second field -->
                              <div class="mb-3">
                                 <input type="text" placeholder="phone" id="phone" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- First field -->
                              <div class="mb-3">
                                 <input type="email" placeholder="email" id="email" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <!-- Second field -->
                              <div class="mb-3">
                                 <input type="text" placeholder="ID" id="unique_id" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-12">
                              <!-- First field -->
                              <div class="mb-3">
                                 <select id="type" class="form-select">
                                    <option value=""> End use type *</option>
                                    <option value="Personal">Personal use</option>
                                    <option value="Business">Resale/Wholesale/Business related use</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <!-- Second field -->
                              <div class="mb-3">
                                 <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="comment" style="height: 100px"></textarea>
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveButton">Save changes</button>
                     </div>
                  </div>
               </div>
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
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <!-- Page Specific JS -->
      <script src="assets/js/app.js?v=<?php echo time(); ?>"></script> 
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerEl = document.getElementById('tooltipTrigger');
            var tooltip = new bootstrap.Tooltip(tooltipTriggerEl, {
                html: true, // Allow HTML content in tooltip
                placement: 'right' // Position of tooltip
            });

             $('#result').select2({
          placeholder: "Select location",
          allowClear: true
        });
        });
        </script>
   </body>
</html>
<?php } else {header("Location: ../index.php");} ?>