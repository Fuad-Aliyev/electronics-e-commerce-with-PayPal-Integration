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
						
						<b style="color: yellow">Shopping Cart:</b> Total Items: <?php echo total_items(); ?> Total Price: <?php echo "$" . total_price(); ?> <a href="index.php" style="color: yellow">Back to Shop</a>

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
					<br>
					<form action="cart.php" method="post" enctype="multipart/form-data">
						<table align="center" width="700px" bgcolor="skyblue">
							<tr align="center">
								<th>Remove</th>
								<th>Products</th>
								<th>Quantity</th>
								<th>Total Price</th>
							</tr>

							<?php
								global $conn;
								$ip = getIp();
								$total = 0;
								$subtotal = 0;


								$select_price = "SELECT * FROM cart WHERE ip_addr = '$ip'";
								$run_price = mysqli_query($conn, $select_price);

								while($p_price = mysqli_fetch_array($run_price)) {

									$pro_id = $p_price['p_id'];

									$pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";

									$run_pro_price = mysqli_query($conn, $pro_price);

									while($pp_price = mysqli_fetch_array($run_pro_price)) {

										$product_price = array($pp_price['product_price']);
										$product_title = $pp_price['product_title'];
										$product_image = $pp_price['product_image'];
										$single_product_price = $pp_price['product_price'];

										$values = array_sum($product_price);

										$total += $values;
										

							?>

							<tr algin="center">
								<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>" /></td>
								<td><?php echo $product_title; ?><br>
									<img src="admin/product_images/<?php echo $product_image; ?>" width="60" height="60" />
								</td>		
								<td><input type="text" size="4" name="quantity" value="<?php echo $_SESSION['quantity']; ?>"/></td>
								<?php
									if(isset($_POST['update_cart'])) {

										$qty = $_POST['quantity'];
										
										$update_quantity = "UPDATE cart SET qty='$qty'";
										$run_quantity = mysqli_query($conn, $update_quantity);

										$_SESSION['quantity'] = $qty;

										$total = $total * $qty;

									}

								?>
								<td><?php echo "$ " . $single_product_price; ?></td>
							</tr>
							<?php } } ?>
							<tr align="right">
								<td colspan="4"><b>Sub Total: </b></td>
								<td colspan="4"><?php echo "$ " . $total; ?></td>
							</tr>
							<tr align="center">
								<td colspan="2"><input type="submit" name="update_cart" value="Update Cart" /></td>
								<td><input type="submit" name="continue" value="Continue Shopping" /></td>
								<td><button><a href="checkout.php" style="text-decoration: none; color: black;">Checkout</a></button></td>
							</tr>
						</table>
					</form>
					<?php
						function updateCart() {

							global $conn;
							$ip = getIp();

							if(isset($_POST['update_cart'])) {

								foreach($_POST['remove'] as $remove_id) {

									$delete_product = "DELETE FROM cart WHERE p_id='$remove_id' AND ip_addr='$ip'";

									$run_delete = mysqli_query($conn, $delete_product);

									if($run_delete) {

										echo "<script>window.open('cart.php','_self')</script>";
									} else {

										echo "<script>alert('Something went wrong :(')</script>";
									}
								}
							}

							if(isset($_POST['continue'])) {

								echo "<script>window.open('index.php','_self')</script>";
							}

							echo @$up_cart = updateCart();
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