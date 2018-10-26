<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

	include("includes/db.php");
	
	if(isset($_GET['delete_c'])) {

		$c_id = $_GET['delete_c'];

		$del_c = "DELETE FROM customers WHERE customer_id='$c_id'";

		$run_delete = mysqli_query($conn, $del_c);

		if($run_delete) {

			echo "<script>alert('Customer has been deleted successfully!!!')</script>";
			echo "<script>window.open('index.php?view_customers', '_self')</script>";
		}
		else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>