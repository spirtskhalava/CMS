<?php
session_start();
include "../db_conn.php";
if (isset($_SESSION["username"]) && isset($_SESSION["id"]) && $_SESSION["role"]=="admin" || $_SESSION['role']=='accountant' || $_SESSION['role']=='dealer') { ?>
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
  </head>
  <body class="app">
    <header class="app-header fixed-top">
      <div class="app-header-inner">
        <div class="container-fluid py-2">
          <div class="app-header-content">
            <div class="row justify-content-between align-items-center">
              <div class="col-auto"> <?php include "../add_balance.php";?> <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                    <title>Menu</title>
                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                  </svg>
                </a>
              </div>
              <!--//col-->
              <div class="app-utilities col-auto"> <?php
                   include "../balance.php";
                   ?> </div>
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
            <a class="app-logo" href="/">
              <img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo">
              <span class="logo-text">PORTAL</span>
            </a>
          </div>
          <!--//app-branding--> <?php include "../sidebar.php"; ?> <?php include "../footer.php"; ?>
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
                            <th class="cell">Action</th>
                            <th class="cell">Details</th>
                            <th class="cell">Date</th>
                          </tr>
                        </thead>
                        <tbody> <?php
                                $user_id=intval($_SESSION['id']);
                                if($_SESSION['role'] == 'dealer') {
                                    $sql = "
                                        SELECT logs.*, users.username FROM logs LEFT JOIN users ON logs.user_id = users.id WHERE action='DISCOUNT' logs.user_id = '$user_id'
                                    ";
                                } else {
                                    $sql = "
                                        SELECT logs.*, users.username FROM logs LEFT JOIN users ON logs.user_id = users.id WHERE action='DISCOUNT'
                                    ";
                                }
                                 $result = mysqli_query($conn, $sql);
                                 while ($row = mysqli_fetch_array($result)) { ?> <tr>
                            <td class="cell"> <?php echo $row["action"]; ?> </td>
                            <td class="cell">
                              <span class=""> <?php echo $row["details"]; ?> </span>
                            </td>
                            <td class="cell">
                              <span class="truncate"> <?php echo $row["timestamp"]; ?> </span>
                            </td>
                          </tr> <?php }
                                           ?> </tbody>
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
      <!-- Javascript -->
      <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <script src="assets/plugins/popper.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
     <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
  </body>
</html> <?php } else {header("Location: ../index.php");} ?>