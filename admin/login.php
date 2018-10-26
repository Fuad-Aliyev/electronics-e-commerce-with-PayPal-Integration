<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" href="styles/login.css" media="all" />
</head>
<body>
	<div class="login">
  		<div class="login-triangle"></div>
  
  		<h2 class="login-header">Log in</h2>

  		<form class="login-container" method="post" action="login.php">
		    <p><input type="email" placeholder="Email" name="email"></p>
		    <p><input type="password" placeholder="Password" name="pass"></p>
		    <p><input type="submit" value="Log in" name="login"></p>
  		</form>
	</div>
</body>
</html>
<?php
	
	include("includes/db.php");

	if(isset($_POST['login'])) {

		$email = mysqli_escape_string($conn, $_POST['email']);
		$pass = mysqli_escape_string($conn, $_POST['pass']);

		$sel = "SELECT * FROM admins WHERE email='$email' AND password='$pass'";

		$run = mysqli_query($conn, $sel);

		$check = mysqli_num_rows($run);

		if($check == 0) {

			echo "<script>alert('Email or Password is incorrect!!! Try again!')</script>";
		} 
		else {

			$_SESSION['email'] = $email;

			echo "<script>window.open('index.php', '_self')</script>";
		}

	}
?>