<?php 
session_start();
include "../db_conn.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {

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

// Pagination logic
$results_per_page = 10; // Number of results per page
$userId = intval($_SESSION['id']);
$vin_filter = isset($_GET['vin_filter']) ? $_GET['vin_filter'] : '';
$vin_filter = '%' . mysqli_real_escape_string($conn, $vin_filter) . '%';

// Determine the total number of results
if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'accountant') {
    $total_sql = "SELECT COUNT(*) FROM vehicles WHERE vin LIKE ?";
} else {
    $total_sql = "SELECT COUNT(*) FROM vehicles WHERE user_id = ? AND vin LIKE ?";
}

if ($stmt = $conn->prepare($total_sql)) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'accountant') {
        $stmt->bind_param("s", $vin_filter);
    } else {
        $stmt->bind_param("is", $userId, $vin_filter);
    }
    
    $stmt->execute();
    $stmt->bind_result($total_rows);
    $stmt->fetch();
    $stmt->close();
    
    $total_pages = ceil($total_rows / $results_per_page);
}

// Determine the current page
$current_page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($current_page < 1) $current_page = 1;
if ($current_page > $total_pages) $current_page = $total_pages;

$offset = ($current_page - 1) * $results_per_page;

// Fetch results for the current page
if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'accountant') {
    $sql = "SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname, consignee.personal_id AS consignee_personal 
            FROM vehicles 
            LEFT JOIN consignee ON vehicles.consigne_id = consignee.id 
            WHERE vehicles.vin LIKE ?
            LIMIT ?, ?";
} else {
    $sql = "SELECT vehicles.*, consignee.firstname AS consignee_name, consignee.lastname AS consignee_lname, consignee.personal_id AS consignee_personal 
            FROM vehicles 
            LEFT JOIN consignee ON vehicles.consigne_id = consignee.id 
            WHERE vehicles.user_id = ? AND vehicles.vin LIKE ?
            LIMIT ?, ?";
}

if ($stmt = $conn->prepare($sql)) {
    if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'accountant') {
        $stmt->bind_param("sii", $vin_filter, $offset, $results_per_page);
    } else {
        $stmt->bind_param("isii", $userId, $vin_filter, $offset, $results_per_page);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    echo "Error preparing the SQL statement.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css?v=<?php echo time(); ?>">
    <style>
      .icon-button {
        background: #007bff;
        border: none;
        color: white;
        cursor: pointer;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
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
        <?php include "../header.php"; ?>
        <div id="app-sidepanel" class="app-sidepanel">
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
                <div class="app-branding">
                    <a class="app-logo" href="dashboard.php">
                        <img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo">
                        <span class="logo-text">PORTAL</span>
                    </a>
                </div> 
                <?php include "../sidebar.php"; ?> 
                <?php include "../footer.php"; ?>
            </div>
        </div>
    </header>
    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-fluid">
                <div class="row g-4 mb-4">
                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <!-- Filter Form -->
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
                                                <?php while ($row = $result->fetch_assoc()) { ?> 
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
                                                <?php } ?> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="app-card-footer">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
          <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>
    <script>
if (document.getElementsByClassName('pay').length > 0) {
    const payButtons = document.getElementsByClassName('pay');
    Array.from(payButtons).forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const deptInput = button.previousElementSibling.value;
            const vehicleId = button.previousElementSibling.previousElementSibling.parentNode.previousElementSibling.dataset.id;
            console.log("deptInput", deptInput);
            console.log("vehicleId", vehicleId);
            fetch('pay.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    'id': vehicleId,
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

if (document.getElementsByClassName('icon-button').length > 0) {
    const iconButtons = document.getElementsByClassName('icon-button');
    Array.from(iconButtons).forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const vehicleId = button.previousElementSibling.previousElementSibling.parentNode.previousElementSibling.dataset.id;
            fetch(`get_vehicle_info.php?id=${vehicleId}`).then(response => response.json()).then(data => {
                const modalTableBody = document.getElementById('modalTableBody');
                modalTableBody.innerHTML = ''; // Clear previous content
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(fine => {
                        modalTableBody.innerHTML += 
                            `<tr>
                                <td>${fine.debt}</td>
                                <td>${fine.comment}</td>
                            </tr>`;
                    });
                } else {
                    modalTableBody.innerHTML = '<tr><td colspan="2">No data found</td></tr>';
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
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php } else {
    header("Location: ../login-index.php");
}
?>