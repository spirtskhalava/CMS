<?php if($_SESSION['role'] !=='admin' && $_SESSION['role'] !=='accountant'){?>
<div class="app-utility-item app-user-dropdown dropdown">
<form action="submit_balance_request.php" method="post" id="balanceRequestForm">
<div class="input-group mb-3">
<input type="hidden" id="dealerId" name="dealer_id" value="<?php echo $_SESSION['id']; ?>">
        <input type="date" class="form-control border-2" id="date" name="date">

        <input type="text" id="amount" name="amount" placeholder="Amount" class="form-control border-2">
        <input type="text" id="user" name="user" placeholder="Full Name" class="form-control border-2">

        <button type="button" class="btn btn-primary border-2" id="submitRequest">Add Balance</button>
    </div>
    </form>
</div>
<?php }?>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
<script>
    $('#submitRequest').click(function(){
    var formData = $('#balanceRequestForm').serialize();
    $.ajax({
        url: '../add_balance_request.php',
        type: 'POST',
        data: formData,
        success: function(response){
            alert('Request submitted successfully');
            window.location.reload();
        }
    });
});
</script> -->