<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Confirm Email</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
	    <!-- <style></style> -->
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<h1>Confirm Email</h1>
		<form action="includes/reset_password.php" method="GET">
			<label>
				<span>Enter your email</span>
				<input type="email" name="email" required="true" />
			</label>
			<input type="submit" name="submit" value="Send Email Confirmation" />
		</form>
	</body>
</html>
