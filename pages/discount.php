<?php
session_start();
include "../db_conn.php";

$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();

$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}
$stmt->close();
$conn->close();

if (isset($_SESSION["username"]) && isset($_SESSION["id"]) && ($_SESSION["role"]=="admin" || $_SESSION['role']=='accountant')) { ?>
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
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .container {
            max-width: 800px;
            margin-top: 30px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .image-preview {
            max-width: 200px;
            border: 1px solid #ddd;
            border-radius: .25rem;
            margin-top: 10px;
        }
        .status-message {
            font-size: 1.1rem;
            font-weight: 500;
            color: #28a745;
            margin-top: 20px;
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
                            <?php include "../add_balance.php"; ?>
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                                    <title>Menu</title>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                                </svg>
                            </a>
                        </div>
                        <div class="app-utilities col-auto">
                            <?php include "../balance.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
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
                    <?php include "../sidebar.php"; ?>
                    <?php include "../footer.php"; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
            <div class="table-responsive">
                      <table class="table app-table-hover mb-0 text-left">
                        <thead>
                          <tr>
                            <th class="cell">ID</th>
                            <th class="cell">Username</th>
                            <th class="cell">Amount</th>
                          </tr>
                        </thead>
                        <tbody> <?php
                                 $sql = "SELECT u.id, u.username, d.discount FROM users u LEFT JOIN discount d ON u.id = d.user_id;";
                                 $result = mysqli_query($conn, $sql);
                                 while ($row = mysqli_fetch_array($result)) { ?> <tr>
                            <td class="cell"> <?php echo $row["id"]; ?> </td>
                            <td class="cell">
                              <span class="truncate"> <?php echo $row["username"]; ?> </span>
                            </td>
                            <td class="cell"> <?php echo $row["discount"]; ?> </td>
                          </tr> <?php }
                                           ?> </tbody>
                      </table>
                    </div>
                <form action="add-discount.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($vehicle['id']) ?>">
                    <div class="mb-3">
                        <label for="carDropdown" class="form-label">Select a user:</label>
                        <select id="carDropdown" name="user_id" class="form-select">
                            <option value="">Select a user</option>
                            <?php foreach ($cars as $car): ?>
                                <option value="<?php echo htmlspecialchars($car['id']); ?>">
                                    <?php echo htmlspecialchars($car['username']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control" id="amount" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#carDropdown').select2({
                placeholder: "Select a car",
                allowClear: true
            });
        });
    </script>
</body>
</html>
<?php } else {
    header("Location: ../index.php");
    exit(); // Ensure no further code is executed
} ?>