<img src="images/ad_banner.jpg" height="100px" width="850px">
			
			<!--Navigation Bar -->
			<div class="menubar">  
				<ul id="menu">
					<li><a href="../index.php">Home</a></li>
					<li><a href="../all_products.php">All Products</a></li>
					<li><a href="customer/my_account.php">My Account</a></li>
					<li><a href="#">Sign Up</a></li>
					<li><a href="../cart.php">Shopping Card</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>

				<!--Search Box -->
				<div id="form">
					<form method="GET" action="search.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Search a Product" />
						<input type="submit" name="search" value="Search" />
					</form>
				</div>
				<!--Search Box Ends-->
			</div>
			<!--Navigation Bar Ends-->
		</div>
		<!--Header Ends -->

		<!--Content Wrapper -->
		<div class="content_wrapper">

			<div id="sidebar">  
				<div id="sidebar_title">My Account</div>
				<ul id="cats">
					<br>
					<?php
						$user = $_SESSION['customer_email'];
						$get_user = "SELECT * FROM customers WHERE customer_email='$user'";
						$run_user = mysqli_query($conn, $get_user);
						$row_user = mysqli_fetch_array($run_user);

						$c_img = $row_user['customer_image'];
						$c_name = $row_user['customer_name'];

						echo "<p style='text-align:center;'><img src='customer_images/$c_img' width='100' height='100' /></p>";
					?>
					
					<li><a href="my_account.php?my_orders">My Orders</a></li>
					<li><a href="my_account.php?edit_account">Edit Account</a></li>
					<li><a href="my_account.php?change_password">Change Password</a></li>
					<li><a href="my_account.php?delete_account">Delete Account</a></li>
				</ul>
			</div>
			<div id="content_area">  

				<?php echo cart(); ?>

				<div id="shopping_cart">
					<span style="font-size: 18px;padding: 5px;line-height: 40px;">

						<?php

							if(isset($_SESSION['customer_email'])) {

								echo "<b style='color: yellow'>Welcome</b> " . $_SESSION['customer_email'];
							} 
						?>


						<?php 

							if(!isset($_SESSION['customer_email'])) {

								echo "<a href='checkout.php' style='color: green;'><b>Login</b></a>";
							} else {

								echo "<a href='../logout.php' style='color: red;'><b>Logout</b></a>";
							}
						 ?>
					</span>
				</div>
				<div id="products_box">
					<?php
						if(!isset($_GET['my_orders'])) { 
							if(!isset($_GET['edit_account'])) {
								if(!isset($_GET['change_password'])) {
									if(!isset($_GET['delete_account'])) {

										echo "<h2 style='padding: 15px;'>Welcome $c_name </h2>
										<br>";
										echo "<b>You can see your orders via clicking this <a href='my_account.php?my_orders'>link</a></b>";
									}
								}
							}
						}
					?>
					<?php

						if(isset($_GET['edit_account'])) {
							include("edit_account.php");	
						}

						if(isset($_GET['change_password'])) {
							include("change_password.php");	
						}
					?>
				</div>
			</div>

		</div>
		<!--Content Wrapper Ends-->

		<!--Footer -->
		<div id="footer">  
			<h2 style="text-align: center; padding-top: 30px;">&copy; 2018 by Fuad Aliyev</h2>
		</div>
		<!--Footer Ends -->
	</div>
</body>
</html>	