<div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= $_SESSION[
                    "name"
                ] ?> - Balance:2000$</a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<li><a class="dropdown-item" href="account.php">Account</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 