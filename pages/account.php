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
         <div class="app-header-inner">
            <div class="container-fluid py-2">
               <div class="app-header-content">
                  <div class="row justify-content-between align-items-center">
                     <div class="col-auto">
                        <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                           <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                              <title>Menu</title>
                              <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                           </svg>
                        </a>
                     </div>
                     <!--//col-->
                     <div class="app-utilities col-auto">
                        <div class="app-utility-item app-user-dropdown dropdown">
                           <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?=$_SESSION['name']?> - Balance:2000$</a>
                           <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                              <li><a class="dropdown-item" href="account.html">Account</a></li>
                              <li>
                                 <hr class="dropdown-divider">
                              </li>
                              <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                           </ul>
                        </div>
                        <!--//app-user-dropdown--> 
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
                  <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
               </div>
               <!--//app-branding-->  
               <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                  <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                     <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link active" href="index.html">
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
                     <!--//nav-item-->
                     <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="docs.html">
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
                        <!--//nav-link-->
                        <div id="submenu-1" class="collapse submenu submenu-1" data-bs-parent="#menu-accordion">
                           <ul class="submenu-list list-unstyled">
                              <li class="submenu-item"><a class="submenu-link" href="notifications.html">Received</a></li>
                              <li class="submenu-item"><a class="submenu-link" href="notifications.html">New Orders</a></li>
                              <li class="submenu-item"><a class="submenu-link" href="account.html">Dispatched</a></li>
                              <li class="submenu-item"><a class="submenu-link" href="settings.html">Received</a></li>
                              <li class="submenu-item"><a class="submenu-link" href="settings.html">Missing info</a></li>
                              <li class="submenu-item"><a class="submenu-link" href="settings.html">Loaded</a></li>
                           </ul>
                        </div>
                     </li>
                     <!--//nav-item-->			
                     <li class="nav-item">
                        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                        <a class="nav-link" href="docs.html">
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
                  </ul>
                  <!--//app-menu-->
               </nav>
               <!--//app-nav-->
               <div class="app-sidepanel-footer">
                  <nav class="app-nav app-nav-footer">
                     <ul class="app-menu footer-menu list-unstyled">
                        <li class="nav-item">
                           <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                           <a class="nav-link" href="settings.html">
                              <span class="nav-icon">
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"/>
                                    <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"/>
                                 </svg>
                              </span>
                              <span class="nav-link-text">Settings</span>
                           </a>
                           <!--//nav-link-->
                        </li>
                        <!--//nav-item-->
                     </ul>
                     <!--//footer-menu-->
                  </nav>
               </div>
               <!--//app-sidepanel-footer-->
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
                  <div class="app-content pt-3 p-md-3 p-lg-4">
                     <div class="container-xl">
                        <h1 class="app-page-title">My Account</h1>
                        <div class="row gy-4">
                           <div class="col-12 col-lg-12">
                              <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
                                 <div class="app-card-header p-3 border-bottom-0">
                                    <div class="row align-items-center gx-3">
                                       <div class="col-auto">
                                          <div class="app-icon-holder">
                                             <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                             </svg>
                                          </div>
                                          <!--//icon-holder-->
                                       </div>
                                       <!--//col-->
                                       <div class="col-auto">
                                          <h4 class="app-card-title">Profile</h4>
                                       </div>
                                       <!--//col-->
                                    </div>
                                    <!--//row-->
                                 </div>
                                 <!--//app-card-header-->
                                 <div class="app-card-body px-4 w-100">
                                    <div class="item border-bottom py-3">
                                       <div class="row justify-content-between align-items-center">
                                          <div class="col-auto">
                                             <div class="item-label mb-2"><strong>Photo</strong></div>
                                             <div class="item-data"><img class="profile-image" src="assets/images/user.png" alt=""></div>
                                          </div>
                                          <!--//col-->
                                          <div class="col text-end">
                                             <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                          </div>
                                          <!--//col-->
                                       </div>
                                       <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                       <div class="row justify-content-between align-items-center">
                                          <div class="col-auto">
                                             <div class="item-label"><strong>Name</strong></div>
                                             <div class="item-data">James Doe</div>
                                          </div>
                                          <!--//col-->
                                          <div class="col text-end">
                                             <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                          </div>
                                          <!--//col-->
                                       </div>
                                       <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                       <div class="row justify-content-between align-items-center">
                                          <div class="col-auto">
                                             <div class="item-label"><strong>Email</strong></div>
                                             <div class="item-data">james.doe@website.com</div>
                                          </div>
                                          <!--//col-->
                                          <div class="col text-end">
                                             <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                          </div>
                                          <!--//col-->
                                       </div>
                                       <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                       <div class="row justify-content-between align-items-center">
                                          <div class="col-auto">
                                             <div class="item-label"><strong>Website</strong></div>
                                             <div class="item-data">
                                                https://johndoewebsite.com
                                             </div>
                                          </div>
                                          <!--//col-->
                                          <div class="col text-end">
                                             <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                          </div>
                                          <!--//col-->
                                       </div>
                                       <!--//row-->
                                    </div>
                                    <!--//item-->
                                    <div class="item border-bottom py-3">
                                       <div class="row justify-content-between align-items-center">
                                          <div class="col-auto">
                                             <div class="item-label"><strong>Location</strong></div>
                                             <div class="item-data">
                                                New York
                                             </div>
                                          </div>
                                          <!--//col-->
                                          <div class="col text-end">
                                             <a class="btn-sm app-btn-secondary" href="#">Change</a>
                                          </div>
                                          <!--//col-->
                                       </div>
                                       <!--//row-->
                                    </div>
                                    <!--//item-->
                                 </div>
                                 <!--//app-card-body-->
                                 <div class="app-card-footer p-4 mt-auto">
                                    <a class="btn app-btn-secondary" href="#">Manage Profile</a>
                                 </div>
                                 <!--//app-card-footer-->
                              </div>
                              <!--//app-card-->
                           </div>
                           <!--//col-->
                        </div>
                        <!--//app-card-footer-->
                     </div>
                     <!--//app-card-->
                  </div>
               </div>
               <!--//row-->
            </div>
            <!--//container-fluid-->
         </div>
      </div>
      <!--//container-fluid-->
      </div><!--//app-content-->
      </div><!--//app-wrapper-->    					
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
   header("Location: ../index.php");
   } ?>