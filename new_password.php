<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Reset Password | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
	    <!-- <style></style> -->
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<h1>Reset Password</h1>
		<form action="includes/password_reset.php">
			<label>
				<span>New Password</span>
				<input type="password" name="password" required="true" />
			</label>
			<br />
			<label>
				<span>Confirm Password</span>
				<input type="passsword" name"password2" required="true" />
			</label>
			<input type="submit" name="submit" value="Reset Password" />
		</form>
	</body>
</html>
