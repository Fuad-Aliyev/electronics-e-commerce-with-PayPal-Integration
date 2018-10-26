<?php
	
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>PayPal Success</title>
</head>
<body>
	<h2><?php echo $_SESSION['customer_email'];  ?></h2>
	<h3>Your payment was successfull!!!</h3>
</body>
</html>