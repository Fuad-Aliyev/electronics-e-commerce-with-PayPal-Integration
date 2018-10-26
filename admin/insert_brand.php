<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

?>
<form action="" method="post" style="padding: 100px;">

	<b>Insert New Brand</b>

	<input type="text" name="new_brand" required />
	<input type="submit" name="add_brand" value="Add Brand" />
</form>

<?php
	
	include("includes/db.php");

	if(isset($_POST['add_brand'])) {

		$new_brand = $_POST['new_brand'];

		$insert_brand = "INSERT INTO brands(brand_title) VALUES ('$new_brand')";

		$run_brand = mysqli_query($conn, $insert_brand);

		if($run_brand) {

			echo "<script>alert('New brand added successfully!!!')</script>";
			echo "<script>window.open('index.php?view_brands', '_self')</script>";
		} else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>