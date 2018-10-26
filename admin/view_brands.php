<?php
	
	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

?>
<table width="700" align="center" bgcolor="pink">

	<tr align="center">
		<td colspan="6"><h2>View All Brands</h2></td>
	</tr>

	<tr align="center" bgcolor="#4286f4">
		<th>Brand ID</th>
		<th>Brand Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
		include("includes/db.php");

		$get_brand = "SELECT * FROM brands";

		$run_brand = mysqli_query($conn, $get_brand);

		$count = 0;

		while($row = mysqli_fetch_array($run_brand)) {
			$brand_id = $row['brand_id'];
			$brand_title = $row['brand_title'];
			$count++;
	?>
	<tr align="center">
		<td><?php echo $count; ?></td>
		<td><?php echo $brand_title; ?></td>
		<td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
		<td><a href="delete_brand.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table>
<?php } ?>