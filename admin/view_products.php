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
		<th>Title</th>
		<th>Image</th>
		<th>Price</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
		include("includes/db.php");

		$get_pro = "SELECT * FROM products";

		$run_pro = mysqli_query($conn, $get_pro);

		$count = 0;

		while($row = mysqli_fetch_array($run_pro)) {
			$pro_id = $row['product_id'];
			$pro_title = $row['product_title'];
			$pro_image = $row['product_image'];
			$pro_price = $row['product_price'];
			$count++;
	?>
	<tr align="center">
		<td><?php echo $count; ?></td>
		<td><?php echo $pro_title; ?></td>
		<td><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60" /></td>
		<td><?php echo $pro_price; ?></td>
		<td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
		<td><a href="delete_pro.php?delete_pro=<?php echo $pro_id; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table>
<?php } ?>