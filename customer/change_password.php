
<br>
<h2 style="text-align: center;">Change Your Password</h2><br>

<form action="" method="POST">
	<table align="center">
		<tr>
			<td style="float: left;"><b>Enter Current Your Password: </b></td>
			<td><input type="password" name="current_password" required /></td>
		</tr>
		<tr>
			<td style="float: left;"><b>Enter New Password: </b></td>
			<td><input type="password" name="new_password" required /></td>
		</tr>
		<tr>
			<td style="float: left;"><b>Enter New Password Again: </b></td>
			<td><input type="password" name="new_password_again" required /></td>
		</tr>
		<tr align="center">
			<td colspan="3"><input type="submit" name="change_password" value="Change Passowrd"></td>
		</tr>
	</table>
</form>

<?php

	include("includes/db.php");

	if(isset($_POST['change_password'])) {

		$user = $_SESSION['customer_email'];
		$current_pass = $_POST['current_password'];
		$new_pass = $_POST['new_password'];
		$new_pass_again = $_POST['new_password_again'];

		$sel_pass = "SELECT * FROM customers WHERE customer_pass='$current_pass' AND customer_email='$user'";
		$run_pass = mysqli_query($conn, $sel_pass);
		$check_pass = mysqli_num_rows[$run_pass];

		if($check_pass == 0) {

			echo "<script>alert('Your current password is wrong!!!')</script>";
			exit();
		}
		if($new_pass_again != $new_pass) {

			echo "<script>alert('Your passwords don't match!!!')</script>";
			exit();
		} else {

			$update_pass = "UPDATE customers SET customer_pass='$new_pass' WHERE customer_email='$user'";
			$run_update = mysqli_query($conn, $update_pass);

			echo "<script>alert('Your password was updated successfully!!!')</script>";
			echo "<script>window.open('my_account.php', '_self')</script>";
		}
	}
?>