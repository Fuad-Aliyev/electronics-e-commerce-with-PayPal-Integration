<?php

	if(!isset($_SESSION['email'])) {

		echo "<script>window.open('login.php', '_self')</script>";
	} 
	else {

	include("includes/db.php");

	if(isset($_GET['edit_pro'])) {

		$get_id = $_GET['edit_pro'];

		$get_pro = "SELECT * FROM products WHERE product_id='$get_id'";

		$run_pro = mysqli_query($conn, $get_pro);

		$row = mysqli_fetch_array($run_pro);

			$pro_id = $row['product_id'];
			$pro_title = $row['product_title'];
			$pro_image = $row['product_image'];
			$pro_price = $row['product_price'];
			$pro_desc = $row['product_desc'];
			$pro_keywords = $row['product_keywords'];
			$pro_cat = $row['product_cat'];
			$pro_brand = $row['product_brand'];

			$get_cat = "SELECT * FROM categories WHERE cat_id='$pro_cat'";

			$run_cat = mysqli_query($conn, $get_cat);

			$row_cat = mysqli_fetch_array($run_cat);

			$cat_title = $row_cat['cat_title'];



			$get_brand = "SELECT * FROM brands WHERE brand_id='$pro_brand'";

			$run_brand = mysqli_query($conn, $get_brand);

			$row_brand = mysqli_fetch_array($run_brand);

			$brand_title = $row_brand['brand_title'];

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Product</title>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  	<script>tinymce.init({ selector:'textarea' });</script>
</head>
<body bgcolor="skyblue">

	<form action="edit_pro.php" method="POST" enctype="multipart/form-data">
		<table align="center" width="700" border="2px" bgcolor="#25346d">
			<tr align="center">
				<td colspan="8"><h2>Edit Product</h2></td>
			</tr>
			<tr>
				<td align="center"><b>Product Title</b></td>
				<td><input type="text" name="product_title" size="60" value="<?php echo $pro_title; ?>" /></td>
			</tr>
			<tr>
				<td align="center"><b>Product Category</b></td>
				<td>
					<select name="product_cat">
						<option><?php echo $cat_title; ?></option>
						<?php
							$get_cats = "SELECT * FROM categories";
							$result = mysqli_query($conn, $get_cats);

							while($row_cats = mysqli_fetch_array($result)) {

								$cat_id = $row_cats['cat_id'];
								$cat_title = $row_cats['cat_title'];

								echo "<option value='$cat_id'>$cat_title</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="center"><b>Product Brand</b></td>
				<td>
					<select name="product_brand">
						<option><?php echo $brand_title; ?></option>
						<?php
							$get_brands = "SELECT * FROM brands";
							$result = mysqli_query($conn, $get_brands);

							while($row_brands = mysqli_fetch_array($result)) {

								$brand_id = $row_brands['brand_id'];
								$brand_title = $row_brands['brand_title'];

								echo "<option value='$brand_id'>$brand_title</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="center"><b>Product Image</b></td>
				<td><input type="file" name="product_image" /><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60" /></td>
			</tr>
			<tr>
				<td align="center"><b>Product Price</b></td>
				<td><input type="text" name="product_price" value="<?php echo $pro_price; ?>" /></td>
			</tr>
			<tr>
				<td align="center"><b>Product Description</b></td>
				<td>
					<textarea name="product_desc" cols="60" rows="5"><?php echo $pro_desc; ?></textarea>
				</td>
			</tr>
			<tr>
				<td align="center"><b>Product Keywords</b></td>
				<td><input type="text" name="product_keywords" size="50" value="<?php echo $pro_keywords; ?>" /></td>
			</tr>
			<tr align="right">
				<td colspan="8"><input type="submit" name="update_product" value="Update Product" /></td>
			</tr>
		</table>
	</form>
</body>
</html>

<?php
	
	if(isset($_POST['update_product'])) {

		//getting data from fields
		$product_id = $pro_id;
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['cat_id'];
		$product_brand = $_POST['brand_id'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];

		//getting the image from the field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];

		move_uploaded_file($product_image_tmp, "product_images/$product_image");

		$update_pro = "UPDATE products SET product_cat='$product_cat', product_brand='$product_brand', product_title='$product_title', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', product_keywords='$product_keywords' WHERE product_id='$product_id'";

		$result = mysqli_query($conn, $update_pro);

		if($result) {

			echo "<script>alert('Successfully updated!!!')</script>";
			echo "<script>window.open('index.php?view_products', '_self')</script>";
		} else {
			echo "<script>alert('Something went wrong!!!')</script>";
		}
	}
}
?>