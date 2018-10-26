<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

?>
<table width="700" align="center" bgcolor="pink">

	<tr align="center">
		<td colspan="6"><h2>View All Products</h2></td>
	</tr>

	<tr align="center" bgcolor="#4286f4">
		<th>S.N</th>
		<th>IP Address</th>
		<th>Name</th>
		<th>Email</th>
		<th>Image</th>
		<th>Country</th>
		<th>City</th>
		<th>Address</th>
		<th>Delete</th>
	</tr>
	<?php
		include("includes/db.php");

		$get_c = "SELECT * FROM customers";

		$run_c = mysqli_query($conn, $get_c);

		$count = 0;

		while($row = mysqli_fetch_array($run_c)) {
			$c_id = $row['customer_id'];
			$c_ip = $row['customer_ip'];
			$c_name = $row['customer_name'];
			$c_email = $row['customer_email'];
			$c_image = $row['customer_image'];
			$c_country = $row['customer_country'];
			$c_city = $row['customer_city'];
			$c_address = $row['customer_address'];
			$count++;
	?>
	<tr align="center">
		<td><?php echo $count; ?></td>
		<td><?php echo $c_ip; ?></td>
		<td><?php echo $c_name; ?></td>
		<td><?php echo $c_email; ?></td>
		<td><img src="../customer/customer_images/<?php echo $c_image; ?>" width="60" height="60" /></td>
		<td><?php echo $c_country; ?></td>
		<td><?php echo $c_city; ?></td>
		<td><?php echo $c_address; ?></td>
		<td><a href="delete_customer.php?delete_c=<?php echo $c_id; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table>
<?php } ?>