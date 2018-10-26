<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

	include("includes/db.php");
	
	if(isset($_GET['delete_cat'])) {

		$cat_id = $_GET['delete_cat'];

		$del_cat = "DELETE FROM categories WHERE cat_id='$cat_id'";

		$run_delete = mysqli_query($conn, $del_cat);

		if($run_delete) {

			echo "<script>alert('Category has been deleted successfully!!!')</script>";
			echo "<script>window.open('index.php?view_categories', '_self')</script>";
		}
		else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>