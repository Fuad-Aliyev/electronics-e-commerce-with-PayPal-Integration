<?php
	include("includes/db.php");

	$user = $_SESSION['customer_email'];
	$get_user = "SELECT * FROM customers WHERE customer_email='$user'";
	$run_user = mysqli_query($conn, $get_user);

	$row_user = mysqli_fetch_array($run_user);

	$id = $row_user['customer_id'];
	$name = $row_user['customer_name'];
	$pass = $row_user['customer_pass'];
	$image = $row_user['customer_image'];
	$city = $row_user['customer_city'];
	$contact = $row_user['customer_contact'];
	$address = $row_user['customer_address'];
?>
			
				<form method="post" action="" enctype="multipart/form-data">
					<table align="center" width="750px">
						<tr align="center">
							<td colspan="6"><h2>Edit Your Account</h2></td>
						</tr>
						<tr>
							<td align="right">Customer Name:</td>
							<td><input type="text" name="c_name" value="<?php echo $name; ?>" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Email:</td>
							<td><input type="Email" name="c_email" value="<?php echo $user; ?>" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Password:</td>
							<td><input type="Password" name="c_pass" value="<?php echo $pass; ?>" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Image:</td>
							<td><input type="file" name="c_image" /><img src="customer_images/<?php echo $image; ?>" width="50" height="50" /></td>
						</tr>
						<tr>
							<td align="right">City:</td>
							<td><input type="text" name="c_city" value="<?php echo $city; ?>" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Contact:</td>
							<td><input type="text" name="c_contact" value="<?php echo $contact; ?>" required /></td>
						</tr>
						<tr>
							<td align="right">Customer Address:</td>
							<td><textarea cols="25" rows="10" name="c_address" required><?php echo $address; ?></textarea></td>
						</tr>
						<tr align="center">
							<td colspan="6"><input type="submit" name="update" value="Update Account" /></td>
						</tr>
					</table>
				</form>
			</div>

		</div>
		<!--Content Wrapper Ends-->
		
<?php
	
	if(isset($_POST['update'])) {

		$ip = getIp();
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];

		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name']; 
		
		

		move_uploaded_file($c_image_tmp, "customer_images/$c_image");

		$update_c = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', customer_city='$c_city', customer_contact='$c_contact', customer_image='$c_image', customer_address='$c_address' WHERE customer_id='$id'";

		$run_c = mysqli_query($conn, $update_c);

		if($run_c) {

			echo "<script>alert('Your account updated successfully!!!')</script>";
			echo "<script>window.open('my_account.php', '_self')</script>";
		}
	}
?>