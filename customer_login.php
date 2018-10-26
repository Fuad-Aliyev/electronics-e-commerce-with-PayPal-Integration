<?php

	include("includes/db.php");
?>

	<div>

		<form method="post" action="">
			<table width="500" align="center" bgcolor="skyblue">

				<tr align="center">
					<td colspan="4"><h2>Login or Register to Buy!</h2></td>
				</tr>
				<br><br>
				<tr>
					<td align="right"><b>Email:</b></td>
					<td><input type="text" name="email" placeholder="enter email" required /></td>
				</tr>
				<tr>
					<td align="right"><b>Password:</b></td>
					<td><input type="password" name="password" placeholder="enter password" required /></td>
				</tr>
				<tr align="center">
					<td colspan="3"><a href="checkout.php?forgot_pass">Forgot Password?</a></td>
				</tr>
				<tr align="center">
					<td colspan="3"><input type="submit" name="login" value="Login" /></td>
				</tr>
			</table>

			<br>
			<h2 style="float: right; padding: 15px;"><a href="customer_register.php" style="text-decoration: none;">New? Register Here</a></h2>
		</form>

		<?php

			if(isset($_POST['login'])) {

				$c_email = $_POST['email'];
				$c_pass = $_POST['password'];

				$sel_customer = "SELECT * FROM customers WHERE customer_pass='$c_pass' AND customer_email='$c_email'";

				$run_customer = mysqli_query($conn, $sel_customer);
				$check_customer = mysqli_num_rows($run_customer);

				if($check_customer == 0) {

					echo "<script>alert('Password or Email is incorrect. Please try again!')</script>";
				} else {

					$ip = getIp();

					$select_cart = "SELECT * FROM cart WHERE ip_addr = '$ip'";

					$run_cart = mysqli_query($conn, $select_cart);

					$check_cart = mysqli_num_rows($run_cart);

					if($check_customer > 0 AND $check_cart == 0) {

						$_SESSION['customer_email'] = $c_email;

						echo "<script>window.open('customer/my_account.php','_self')</script>";
						exit();
					} else {

						$_SESSION['customer_email'] = $c_email;

						echo "<script>window.open('checkout.php','_self')</script>";
					}
				}
			}
		?>
	</div>