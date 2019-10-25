<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Sign In | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
	    <!-- <style></style> -->
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<h1>Sign In</h1>
		<form action="includes/signin.php" method="POST">
			<label>
				<span>Username</span>
				<input type="text" name="username" required="true" />
			</label>
			<br />
			<label>
				<span>Password</span>
				<input type="password" name="password" required="true" />
			</label>
			<input type="submit" name="submit" value="Sign In" />
		</form>
		<a href="reinit_password.php">Forgot Password? Click here</a>
	</body>
</html>
