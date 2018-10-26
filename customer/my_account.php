<?php
	session_start();
	include ("functions/functions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ecommerce</title>
	<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
	<!--Main Container -->
	<div class="main_wrapper">
		<!--Header -->
		<div class="header_wrapper">  
			<a style="margin-top: -12px; margin-left: -27px;" class="navbar-brand" href="index.php"><img src="images/logo.jpg" width="170px"></a>
			<?php  
				if(!isset($_SESSION['customer_email'])) {

					echo "<script>window.open('../checkout.php', '_self')</script>";
				} else {
					include("my_account_processing.php");
				}
			?>
