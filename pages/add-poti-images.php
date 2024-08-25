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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
	
			            
                    <?php include "../balance.php"; ?>
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
                <form id="vehicleForm" action="update-poti.php" method="post" enctype="multipart/form-data">
                    <!-- VIN Search Section -->
                    <div class="mb-3">
                        <label for="vinCode" class="form-label">Enter VIN Code:</label>
                        <input type="text" id="vinCode" class="form-control" placeholder="Enter VIN code">
                        <button type="button" id="searchVin" class="btn btn-primary mt-2">Search</button>
                    </div>

                    <!-- Vehicle Info Section -->
                    <div class="mb-3">
                        <label for="carDropdown" class="form-label">Select a car:</label>
                        <select id="carDropdown" name="car_id" class="form-select">
                            <option value="">Select a car</option>
                        </select>
                    </div>

                    <!-- Hidden Input for Vehicle ID -->
                    <input type="hidden" id="vehicleId" name="vehicle_id">

                    <!-- Image Upload Sections -->
                    <div class="mb-3">
                        <label for="images1" class="form-label">PICK UP - Upload Images (Up to 3)</label>
                        <input type="file" class="form-control" id="images1" name="images1[]" multiple accept="image/*">
                        <div class="images1-preview-container" id="images1-previews"></div>
                    </div>

                    <div class="mb-3">
                        <label for="images2" class="form-label">WAREHOUSE - Upload Images (Up to 3)</label>
                        <input type="file" class="form-control" id="images2" name="images2[]" multiple accept="image/*">
                        <div class="images2-preview-container" id="images2-previews"></div>
                    </div>

                    <div class="mb-3">
                        <label for="images3" class="form-label">GEORGIA - Upload Images (Up to 3)</label>
                        <input type="file" class="form-control" id="images3" name="images3[]" multiple accept="image/*">
                        <div class="images3-preview-container" id="images3-previews"></div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Vehicle</button>
                </form>
            </div>
        </div>  
    </div><!--//app-wrapper-->    	

    <!-- Javascript -->          
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 
    <script>
        // Handle VIN Code Search
        document.getElementById('searchVin').addEventListener('click', function() {
            const vinCode = document.getElementById('vinCode').value;
            if (vinCode.trim() === '') {
                alert('Please enter a VIN code.');
                return;
            }

            $.ajax({
                url: 'fetch_vehicle_data.php',
                method: 'POST',
                data: { vin: vinCode },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const carDropdown = document.getElementById('carDropdown');
                        carDropdown.innerHTML = `<option value="${response.vehicle.id}">${response.vehicle.make} ${response.vehicle.model} ${response.vehicle.vin}</option>`;
                        document.getElementById('vehicleId').value = response.vehicle.id;
                    } else {
                        alert('No vehicle found for the provided VIN code.');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching vehicle information.');
                }
            });
        });

        // Handle image previews
        Array.from(document.getElementsByTagName('input')).forEach(input => {
            if (input.type === 'file' && (input.id === 'images1' || input.id === 'images2' || input.id === 'images3')) {
                input.addEventListener('change', function(event) {
                    const previewContainer = document.getElementById(event.target.id + '-previews');
                    previewContainer.innerHTML = '';
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
            }
        });
    </script>
</body>
</html>
<?php } else { header("Location: ../index.php"); } ?>