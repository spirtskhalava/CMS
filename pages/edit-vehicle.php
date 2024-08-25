<?php
session_start();
include "../db_conn.php";
$vehicleId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch current vehicle details
$query = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $vehicleId);
$stmt->execute();
$result = $stmt->get_result();
$vehicle = $result->fetch_assoc();
$stmt->close();

if (!$vehicle) {
    die("Vehicle not found.");
}
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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <?php include "../add_balance.php";?>
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		
		            <div class="app-utilities col-auto">
	
			            
                    <?php
                   include "../balance.php";
                   ?>
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
	
		        </div><!--//app-branding-->  
		        
			    <?php include "../sidebar.php"; ?>
				<?php include "../footer.php"; ?>
			    
		       
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container">
        <h1 class="mb-4">Edit Vehicle</h1>
        <form action="update-vehicle.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($vehicle['id']) ?>">
            <input type="hidden" name="destination" id="destination" value="<?= htmlspecialchars($vehicle['branch']) ?>">

            <div class="mb-3">
                <label for="make" class="form-label">Make</label>
                <input type="text" class="form-control" id="make" name="make" value="<?= htmlspecialchars($vehicle['make']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="<?= htmlspecialchars($vehicle['model']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" class="form-control" id="year" name="year" value="<?= htmlspecialchars($vehicle['year']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($vehicle['price']) ?>" step="0.01" required>
            </div>
            
             <div class="mb-3">
                <label for="lot" class="form-label">Lot</label>
                <input type="number" class="form-control" id="lot" name="lot" value="<?= htmlspecialchars($vehicle['lot']) ?>" step="0.01" required>
            </div>

               <div class="mb-3">
                <label for="auction" class="form-label">Port of Load</label>
                <input type="text" class="form-control" id="container_name" name="container_name" value="<?= htmlspecialchars($vehicle['container_name']) ?>" step="0.01" required>
            </div>

             <div class="mb-3">
                <label for="auction" class="form-label">Auction</label>
                <input type="text" class="form-control" id="auction" name="auction" value="<?= htmlspecialchars($vehicle['auction']) ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="dest" class="form-label">Branch</label>
                <?php
                 //htmlspecialchars($vehicle['branch'])
                 ?>
                 <select class="form-select" name="dest" id="res" aria-label="Default select example">
                  </select>
            </div>

            <div class="mb-3">
                <label for="dest" class="form-label">Booking ID</label>
                <input type="text" class="form-control" id="booking_id" name="booking_id" value="<?= htmlspecialchars($vehicle['booking_id']) ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="dest" class="form-label">Container ID</label>
                <input type="text" class="form-control" id="container_id" name="container_id" value="<?= htmlspecialchars($vehicle['container_id']) ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Pending" <?= $vehicle['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="New" <?= $vehicle['status'] == 'New' ? 'selected' : '' ?>>New</option>
                    <option value="Loading" <?= $vehicle['status'] == 'Loading' ? 'selected' : '' ?>>Loading</option>
                    <option value="Arrived" <?= $vehicle['status'] == 'Arrived' ? 'selected' : '' ?>>Arrived</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="has_key" class="form-label">Has Key</label>
                <select class="form-select" id="has_key" name="has_key">
                    <option value="">Choose</option>
                    <option value="Yes" <?= $vehicle['has_key'] == 'Yes' ? 'selected' : '' ?>>Yes</option>
                    <option value="No" <?= $vehicle['status'] == 'No' ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="images" class="form-label">Upload Images (Up to 15)</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                <div class="image-preview-container" id="image-previews">
                    <!-- Image previews will be inserted here -->
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Vehicle</button>
        </form>

        <!-- Status message -->
        <div class="status-message" id="status-message" style="display: none;">
            Vehicle details updated successfully.
        </div>
    </div>
        </div>  
	    
	    
    </div><!--//app-wrapper-->    	

    <!-- Javascript -->          
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
        document.getElementById('images').addEventListener('change', function() {
            const previewContainer = document.getElementById('image-previews');
            previewContainer.innerHTML = ''; // Clear existing previews

            const files = this.files;
            for (const file of files) {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'image-preview';
                        previewContainer.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            }
        });

const modelDropdown = document.getElementById("res");
const selectedBrand = document.getElementById("destination");

if (modelDropdown) {
    modelDropdown.innerHTML = "<option value=''>Select Location</option>";
    fetch("http://artoflab.com/portal/fetch_all_auction.php?location=" + encodeURIComponent(selectedBrand.value))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok, status: ' + response.status);
            }
            return response.json();
        })
        .then(options => {
            if (Array.isArray(options)) {
                options.forEach(function(optionData) {
                    const option = document.createElement('option');
                    option.value = optionData.value;
                    option.textContent = optionData.text || optionData.value;
                    if (optionData.selected) {
                        option.selected = true;
                    }

                    modelDropdown.appendChild(option);
                });
            } else {
                console.error('Unexpected format of options:', options);
            }
            
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
    }

    $('#res').select2({
          placeholder: "Select a car",
          allowClear: true
        });

        if (window.location.search.indexOf('updated') > -1) {
            document.getElementById('status-message').style.display = 'block';
        }
    </script>

</body>
</html>
<?php } else {header("Location: ../index.php");} ?>