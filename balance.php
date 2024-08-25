<style>
  #debt{
   color:red;
  } 
 #balance{
   color:green;
   text-decoration: none;
  } 
  .dropdown-toggle{
      text-decoration:none;
  }
</style>   
<div class="app-utility-item app-user-dropdown dropdown">
<span id="balance"></span>
<span id="debt"></span>
&nbsp;
&nbsp;
<a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
<?php echo $_SESSION['name']; ?>
</a>
   <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
      <li><a class="dropdown-item" href="account.php">Account</a></li>
      <li>
         <hr class="dropdown-divider">
      </li>
      <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
   </ul>
</div>