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
                                            <th>ID</th>
                                            <th>Dealer</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Person Name</th>
                                            <th>Action</th>
											</tr>
										</thead>
                                        <tbody id="requestsTableBody">
                                            <!-- Rows will be populated by JavaScript -->
                                        </tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						
			        </div><!--//tab-pane-->
			        
				</div>
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    
    </div><!--//app-wrapper-->    	
	
	<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="recordId">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
					<div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role">
                        </select>
                    </div>
					<input type="hidden" id="user_id" name="user_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="fname" name="fname">
                    </div>
					<div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="user_name" name="user_name">
                    </div>
                    <div class="mb-3">
                        <label for="user_role" class="form-label">Role</label>
                        <select class="form-control" id="user_role" name="user_role">
							<option value="admin">admin</option>
							<option value="dealer">dealer</option>
							<option value="accountant">accountant</option>
                        </select>
                    </div>
					<div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveRecord">Save changes</button>
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
$(document).ready(function(){
    // Fetch and display balance requests
    $.ajax({
        url: 'fetch_balance_requests.php',
        type: 'GET',
        dataType: 'json',
        success: function(requests) {
            var rows = '';
            $.each(requests, function(index, request) {
                var statusText = '';
                var statusDisplay = 'none';
                if (request.status === 'confirmed') {
                    statusText = 'Confirmed';
                    statusDisplay = 'inline';
                } else if (request.status === 'rejected') {
                    statusText = 'Rejected';
                    statusDisplay = 'inline';
                }

                rows += '<tr>' +
                    '<td>' + request.id + '</td>' +
                    '<td>' + request.dealer_name + '</td>' +
                    '<td>' + request.request_date + '</td>' +
                    '<td>' + request.amount + '</td>' +
                    '<td>' + request.person_name + '</td>' +
                    '<td>' +
                        '<div class="request-item" data-id="' + request.id + '">' +
                            '<button class="btn btn-success confirm-btn" data-id="' + request.id + '" style="display:' + (request.status === 'pending' ? 'inline' : 'none') + ';">Confirm</button>' +
                            '<button class="btn btn-danger reject-btn" data-id="' + request.id + '" style="display:' + (request.status === 'pending' ? 'inline' : 'none') + ';">Reject</button>' +
                            '<span class="status-text" style="display:' + statusDisplay + ';">' + statusText + '</span>' +
                        '</div>' +
                    '</td>' +
                '</tr>';
            });
            $('#requestsTableBody').html(rows);
        },
        error: function() {
            alert('An error occurred while fetching balance requests.');
        }
    });

    // Confirm balance request
    $(document).on('click', '.confirm-btn', function() {
        var $requestItem = $(this).closest('.request-item');
        var id = $(this).data('id');

        $.ajax({
            url: 'confirm_balance_request.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                // Check for success message from the server
                if (response.trim() === 'Request confirmed successfully') {
                    $requestItem.find('.confirm-btn').hide();
                    $requestItem.find('.reject-btn').hide();
                    $requestItem.find('.status-text').text('Confirmed').show();
                    updateDropdownBalance();
                } else {
                    alert('Error: ' + response);
                }
            },
            error: function() {
                alert('An error occurred while processing your request.');
            }
        });
    });

    // Reject balance request
    $(document).on('click', '.reject-btn', function() {
        var $requestItem = $(this).closest('.request-item');
        var id = $(this).data('id');

        $.ajax({
            url: 'reject_balance_request.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                if (response.trim() === 'Request rejected successfully') {
                    $requestItem.find('.confirm-btn').hide();
                    $requestItem.find('.reject-btn').hide();
                    $requestItem.find('.status-text').text('Rejected').show();
                } else {
                    alert('Error: ' + response);
                }
            },
            error: function() {
                alert('An error occurred while processing your request.');
            }
        });
    });
});
</script>

</body>
</html>
<?php } else {header("Location: ../index.php");} ?>
