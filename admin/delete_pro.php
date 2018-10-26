<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

	include("includes/db.php");
	
	if(isset($_GET['delete_pro'])) {

		$pro_id = $_GET['delete_pro'];

		$del_pro = "DELETE FROM products WHERE product_id='$pro_id'";

		$run_delete = mysqli_query($conn, $del_pro);

		if($run_delete) {

			echo "<script>alert('Product has been deleted successfully!!!')</script>";
			echo "<script>window.open('index.php?view_products', '_self')</script>";
		}
		else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>