<?php

$conn = mysqli_connect("localhost", "root", "fuadaliyev", "shop");

//Gets IP address of visitors
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
 
 //check "Add to Cart" button for avoiding muliplication of product adding
function cart() {

	global $conn;

	if(isset($_GET['add_cart'])) {

		$ip = getIp();
		$pro_id = $_GET['add_cart'];
		$check_pro = "SELECT * FROM cart WHERE ip_addr='$ip' AND p_id='$pro_id'";

		$run_check = mysqli_query($conn, $check_pro);
		if(mysqli_num_rows($run_check) > 0) {

			echo "";
		} else {
			$insert_pro = "INSERT INTO cart (p_id, ip_addr) VALUES ('$pro_id','$ip')";
			$run_pro = mysqli_query($conn, $insert_pro);
			if($run_pro) {

				echo "<script>window.open('index.php','_self')</script>";
			} else {
				echo "<script>alert('Something went wrong!!!')</script>";
			}
		}
	}
}

//getting the total added items
function total_items() {

	global $conn;

	if(isset($_GET['add_cart'])) {

		$ip = getIp();

		$get_items = "SELECT * FROM cart WHERE ip_addr = '$ip'";
		$run_items = mysqli_query($conn, $get_items);

		$count_items = mysqli_num_rows($run_items);
	} else {

		$ip = getIp();

		$get_items = "SELECT * FROM cart WHERE ip_addr = '$ip'";
		$run_items = mysqli_query($conn, $get_items);

		$count_items = mysqli_num_rows($run_items);
	}

	echo $count_items;
}

//getting total price of items in the cart
function total_price() {

	global $conn;
	$ip = getIp();
	$total = 0;

	$select_price = "SELECT * FROM cart WHERE ip_addr = '$ip'";
	$run_price = mysqli_query($conn, $select_price);

	while($p_price = mysqli_fetch_array($run_price)) {

		$pro_id = $p_price['p_id'];

		$pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";

		$run_pro_price = mysqli_query($conn, $pro_price);

		while($pp_price = mysqli_fetch_array($run_pro_price)) {

			$product_price = array($pp_price['product_price']);

			$values = array_sum($product_price);

			$total += $values;
		}
	}

	echo $total;
}

//getting the categories
function getCats() {

	global $conn;
	$get_cats = "SELECT * FROM categories";
	$result = mysqli_query($conn, $get_cats);

	while($row_cats = mysqli_fetch_array($result)) {

		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}


//getting the brands
function getBrands() {

	global $conn;
	$get_brands = "SELECT * FROM brands";
	$result = mysqli_query($conn, $get_brands);

	while($row_brands = mysqli_fetch_array($result)) {

		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

//gettting the products
function getPro() {

	if(!isset($_GET['cat'])) {

		if(!isset($_GET['brand'])) {

			global $conn;

			$get_pro = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";
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
						<a href='index.php?add_cart=$pro_id'><button style='float: right;'>Add to Cart</button></a>
					</div>
				";
			}
		}
	}
}

//gettting the products for selected category
function getCatPro() {

	if(isset($_GET['cat'])) {

		$cat_id = $_GET['cat'];
		global $conn;

		$get_cat_pro = "SELECT * FROM products WHERE product_cat = '$cat_id'";
		$result = mysqli_query($conn, $get_cat_pro);

		$count_cats = mysqli_num_rows($result);

		if($count_cats == 0) {

			echo "<h2 style='padding: 20px;'>There is no product in this category</h2>";
			exit();
		}

		while($row_cat_pro = mysqli_fetch_array($result)) {

			$pro_cat_id = $row_cat_pro['product_id'];
			$pro_cat_cat = $row_cat_pro['product_cat'];
			$pro_cat_brand = $row_cat_pro['product_brand'];
			$pro_cat_title = $row_cat_pro['product_title'];
			$pro_cat_price = $row_cat_pro['product_price'];
			$pro_cat_image = $row_cat_pro['product_image'];

			echo "
				<div id='single_product'>
					<h3>$pro_cat_title</h3>
					<img src='admin/product_images/$pro_cat_image' width='180' height='180' />
					<p><b> $ $pro_cat_price </b></p>

					<a href='details.php?pro_cat_id=$pro_cat_id' style='float: left;'>Details</a>
					<a href='index.php?pro_cat_id=$pro_cat_id'><button style='float: right;'>Add to Cart</button></a>
				</div>
			";
		}
	}
}

//gettting the products for selected brand
function getBrandPro() {

	if(isset($_GET['brand'])) {

		$brand_id = $_GET['brand'];
		global $conn;

		$get_brand_pro = "SELECT * FROM products WHERE product_brand = '$brand_id'";
		$result = mysqli_query($conn, $get_brand_pro);

		$count_brands = mysqli_num_rows($result);

		if($count_brands == 0) {

			echo "<h2 style='padding: 20px;'>There is no product in this brand</h2>";
			exit();
		}

		while($row_brand_pro = mysqli_fetch_array($result)) {

			$pro_brand_id = $row_brand_pro['product_id'];
			$pro_brand_cat = $row_brand_pro['product_cat'];
			$pro_brand_brand = $row_brand_pro['product_brand'];
			$pro_brand_title = $row_brand_pro['product_title'];
			$pro_brand_price = $row_brand_pro['product_price'];
			$pro_brand_image = $row_brand_pro['product_image'];

			echo "
				<div id='single_product'>
					<h3>$pro_brand_title</h3>
					<img src='admin/product_images/$pro_brand_image' width='180' height='180' />
					<p><b> $ $pro_brand_price </b></p>

					<a href='details.php?pro_brand_id=$pro_brand_id' style='float: left;'>Details</a>
					<a href='index.php?pro_brand_id=$pro_brand_id'><button style='float: right;'>Add to Cart</button></a>
				</div>
			";
		}
	}
}
?>