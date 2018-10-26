<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

	include("includes/db.php");

	if(isset($_GET['edit_cat'])) {

		$cat_id = $_GET['edit_cat'];

		$get_cat = "SELECT * FROM categories WHERE cat_id = '$cat_id'";

		$run_cat = mysqli_query($conn, $get_cat);

		$row = mysqli_fetch_array($run_cat);

		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
	}
?>

<form action="" method="post" style="padding: 100px;">

	<input type="text" name="new_cat" value="<?php echo $cat_title; ?>" />
	<input type="submit" name="update_cat" value="Update Category" />
</form>

<?php

	if(isset($_POST['update_cat'])) {

		$update_id = $cat_id;

		$new_cat = $_POST['new_cat'];

		$update_cat = "UPDATE categories SET cat_title='$new_cat' WHERE cat_id='$update_id'";

		$run_cat = mysqli_query($conn, $update_cat);

		if($run_cat) {

			echo "<script>alert('Category has been updated successfully!!!')</script>";
			echo "<script>window.open('index.php?view_categories', '_self')</script>";
		} else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>