<?php

	if(!isset($_SESSION['email']))
		echo "<script>window.open('login.php', '_self')</script>";
	else
?>
	<form action="" method="post" style="padding: 100px;">

		<b>Insert New Category</b>

		<input type="text" name="new_cat" required />
		<input type="submit" name="add_cat" value="Add Category" />
	</form>

<?php
	
	include("includes/db.php");

	if(isset($_POST['add_cat'])) {

		$new_cat = $_POST['new_cat'];

		$insert_cat = "INSERT INTO categories(cat_title) VALUES ('$new_cat')";

		$run_cat = mysqli_query($conn, $insert_cat);

		if($run_cat) {

			echo "<script>alert('New category added successfully!!!')</script>";
			echo "<script>window.open('index.php?view_categories', '_self')</script>";
		} else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
?>
