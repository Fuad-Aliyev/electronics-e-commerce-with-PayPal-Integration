<?php
	session_start();
	include ("functions/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ecommerce</title>
	<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
	<!--Main Container -->
	<div class="main_wrapper">
		<!--Header -->
		<div class="header_wrapper">  
			<a style="margin-top: -12px; margin-left: -27px;" class="navbar-brand" href="index.php"><img src="images/logo.jpg" width="170px"></a>
			<img src="images/ad_banner.jpg" height="100px" width="850px">

			<!--Navigation Bar -->
			<div class="menubar">  
				<ul id="menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="all_products.php">All Products</a></li>
					<li><a href="customer/my_account.php">My Account</a></li>
					<li><a href="#">Sign Up</a></li>
					<li><a href="cart.php">Shopping Card</a></li>
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
				<div id="sidebar_title">Categories</div>
				<ul id="cats">
					<?php echo getCats(); ?>
				</ul>

				<div id="sidebar_title">Brands</div>
				<ul id="cats">
					<?php echo getBrands(); ?>
				</ul>
			</div>

			<div id="content_area">  

				<?php echo cart(); ?>

				<div id="shopping_cart">
					<span style="font-size: 18px;padding: 5px;line-height: 40px;">

						<?php
							if(isset($_SESSION['customer_email'])) {

								echo "<b style='color: yellow'>Welcome</b> " . $_SESSION['customer_email'];
							} else {

								echo "<b style='color: yellow'>Welcome Guest</>";
							}
						?>

						<b style="color: yellow">Shopping Cart:</b> Total Items: <?php echo total_items(); ?> Total Price: <?php echo "$" . total_price(); ?> <a href="cart.php" style="color: yellow">Go to Cart</a>

						<?php 

							if(!isset($_SESSION['customer_email'])) {

								echo "<a href='checkout.php' style='color: green;'><b>Login</b></a>";
							} else {

								echo "<a href='logout.php' style='color: red;'><b>Logout</b></a>";
							}
						 ?>
					</span>
				</div>
				<div id="products_box">
					<?php echo getPro(); ?>
					<?php echo getCatPro(); ?>
					<?php echo getBrandPro(); ?>
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