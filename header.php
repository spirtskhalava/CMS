<div class="app-header-inner">
<input type="hidden" id="userID" value="<?php echo $_SESSION['username']; ?>">
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