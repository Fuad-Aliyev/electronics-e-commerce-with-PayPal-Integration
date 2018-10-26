<div>
<?php
	
	include("includes/db.php");

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

			$product_name = $pp_price['product_title'];

			$values = array_sum($product_price);

			$total += $values;
		}
	}
?>
	<h2 align="center">Pay now with Paypal</h2><br>
	
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

		  <!-- Identify your business so that you can collect the payments. -->
		  <input type="hidden" name="business" value="businessf@gmail.com">

		  <!-- Specify a Buy Now button. -->
		  <input type="hidden" name="cmd" value="_xclick">

		  <!-- Specify details about the item that buyers will purchase. -->
		  <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
		  <input type="hidden" name="amount" value="<?php echo $total; ?>">
		  <input type="hidden" name="currency_code" value="USD">

		  <!-- Display the payment button. -->
		  <input type="image" name="submit" border="0"
		  src="images/paypalexpress.png" width="200"; 
		  alt="Buy Now">
		  <img alt="" border="0" width="1" height="1"
		  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

	</form>
</div>