<?php
require_once ('includes/ft_util.php');
if (issetstr($_SESSION['username']) && issetstr($_SESSION['id'])) {
	ft_redirectuser();
}
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Sign Up | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
	    <!-- <style></style> -->
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<h1>Sign Up</h1>
		<form action="includes/registration.php" method="POST">
			<label>
				<span>Username</span>
				<input type="text" name="username" required="true" />
			</label>
			<br />
			<label>
				<span>Email</span>
				<input type="email" name="email" required="true" />
			</label>
			<br />
			<label>
				<span>Password</span>
				<input type="password" name="password" required="true" />
			</label>
			<br />
			<label>
				<span>Confirm Password</span>
				<input type="password" name="password2" required="true"/>
			</label>
			<br />
			<input type="submit" name="submit" value="Sign Up" />
		</form>
	</body>
</html>

