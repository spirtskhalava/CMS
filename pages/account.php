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
    body {
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
}

.profile-info, .change-password {
    margin: 20px;
    padding: 20px;
}

label {
    display: block;
    margin: 10px 0 5px;
}

input[type="password"], input[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

p {
    color: red;
}
</style>
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
            <a class="app-logo" href="index.html">
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
                    <div class="profile-info p-2">
                    <?php
                    $userId = intval($_SESSION['id']);
                   $sql = "SELECT 
                        u.role, 
                        u.pbalance, 
                        u.username, 
                        u.name, 
                        COALESCE(SUM(v.debt), 0) AS total_debt 
                    FROM 
                        users u 
                    LEFT JOIN 
                        vehicles v 
                    ON 
                        u.id = v.user_id 
                    WHERE 
                        u.id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $user = $stmt->get_result()->fetch_assoc();
                    $stmt->close();
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
                        $newPassword = $_POST['new_password'];
                        $confirmPassword = $_POST['confirm_password'];
                        $stmt->close();
                            if ($newPassword === $confirmPassword) {
                                $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                                $sql = "UPDATE users SET password = ? WHERE id = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("si", $newPasswordHash, $userId);

                                if ($stmt->execute()) {
                                    $message = "Password updated successfully.";
                                } else {
                                    $message = "Error updating password.";
                                }
                                $stmt->close();
                            } else {
                                $message = "New passwords do not match.";
                            }
                         
                    }

                    $conn->close();
                    ?>
                    <h2>Account Information</h2>
                    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
                    <?php if($_SESSION['role']!=='admin'){?>
                    <p><strong>Balance:</strong> <?php echo htmlspecialchars($user['pbalance']); ?>$</p>
                    <p><strong>Debt:</strong> <?php echo htmlspecialchars($user['total_debt']); ?>$</p>
                    </div>
                    <? }?>
                     <div class="change-password">
                        <h2>Change Password</h2>
                        <form method="post" action="">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" required>

                            <label for="confirm_password">Confirm New Password:</label>
                            <input type="password" id="confirm_password" name="confirm_password" required>

                            <input type="submit" name="update_password" value="Update Password">
                        </form>
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
      <!-- Page Specific JS -->
      <script src="assets/js/app.js"></script>
  </body>
</html> <?php } else {header("Location: ../index.php");} ?>