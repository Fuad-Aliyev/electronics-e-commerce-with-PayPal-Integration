<?php

	$conn = mysqli_connect("localhost", "root", "fuadaliyev", "shop");

	if(mysqli_connect_error()) {

		echo "Failed to connect to Database" . mysqli_connect_error();
	}
?>
