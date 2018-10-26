<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

	include("includes/db.php");

	if(isset($_GET['edit_brand'])) {

		$brand_id = $_GET['edit_brand'];

		$get_brand = "SELECT * FROM brands WHERE brand_id = '$brand_id'";

		$run_brand = mysqli_query($conn, $get_brand);

		$row = mysqli_fetch_array($run_brand);

		$brand_id = $row['brand_id'];
		$brand_title = $row['brand_title'];
	}
?>
<form action="" method="post" style="padding: 100px;">

	<input type="text" name="new_brand" value="<?php echo $brand_title; ?>" />
	<input type="submit" name="update_brand" value="Update Brand" />
</form>

<?php
	
	if(isset($_POST['update_brand'])) {

		$updated_id = $brand_id;
		$new_brand = $_POST['new_brand'];

		$update_brand = "UPDATE brands SET brand_title='$new_brand' WHERE brand_id='$updated_id'";

		$run_brand = mysqli_query($conn, $update_brand);

		if($run_brand) {

			echo "<script>alert('Brand has been updated successfully!!!')</script>";
			echo "<script>window.open('index.php?view_brands', '_self')</script>";
		} else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>