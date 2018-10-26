<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

?>
<table width="700" align="center" bgcolor="pink">

	<tr align="center">
		<td colspan="6"><h2>View All Categories</h2></td>
	</tr>

	<tr align="center" bgcolor="#4286f4">
		<th>Category ID</th>
		<th>Category Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
		include("includes/db.php");

		$get_cat = "SELECT * FROM categories";

		$run_cat = mysqli_query($conn, $get_cat);

		$count = 0;

		while($row = mysqli_fetch_array($run_cat)) {
			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
			$count++;
	?>
	<tr align="center">
		<td><?php echo $count; ?></td>
		<td><?php echo $cat_title; ?></td>
		<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
		<td><a href="delete_cat.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table
<?php } ?>