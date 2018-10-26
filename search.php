<?php
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
				<div id="shopping_cart">
					<span style="font-size: 18px;padding: 5px;line-height: 40px;">
						Welcome Guest! <b style="color: yellow">Shopping Cart:</b> Total Items: Total Price: <a href="cart.php" style="color: yellow">Go to Cart</a>
					</span>
				</div>
				<div id="products_box">
					<?php
						if(isset($_GET['search'])) {

							$search_query = $_GET['user_query'];

							$get_pro = "SELECT * FROM products WHERE product_keywords LIKE '%$search_query%'";
							$result = mysqli_query($conn, $get_pro);

							while($row_pro = mysqli_fetch_array($result)) {

								$pro_id = $row_pro['product_id'];
								$pro_cat = $row_pro['product_cat'];
								$pro_brand = $row_pro['product_brand'];
								$pro_title = $row_pro['product_title'];
								$pro_price = $row_pro['product_price'];
								$pro_image = $row_pro['product_image'];

								echo "
									<div id='single_product'>
										<h3>$pro_title</h3>
										<img src='admin/product_images/$pro_image' width='180' height='180' />
										<p><b> $ $pro_price </b></p>

										<a href='details.php?pro_id=$pro_id' style='float: left;'>Details</a>
										<a href='index.php?pro_id=$pro_id'><button style='float: right;'>Add to Cart</button></a>
									</div>
								";
							}
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