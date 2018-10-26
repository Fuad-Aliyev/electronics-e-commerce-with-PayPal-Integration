<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {
	
	include("includes/db.php");
	
	if(isset($_GET['delete_brand'])) {

		$brand_id = $_GET['delete_brand'];

		$del_brand = "DELETE FROM brands WHERE brand_id='$brand_id'";

		$run_delete = mysqli_query($conn, $del_brand);

		if($run_delete) {

			echo "<script>alert('Brand has been deleted successfully!!!')</script>";
			echo "<script>window.open('index.php?view_brands', '_self')</script>";
		}
		else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>