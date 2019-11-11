<?php
require_once ('includes/ft_util.php');
ft_session_start();
stfu();
if (isset($_SESSION['username']) || isset($_SESSION['id']))
	ft_redirectuser();
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Confirm Email</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css" media="all" />
	</head>
	<body>
		<header class="header">
			<a href="index.php">
				<div class="logo">
					<img src="images/icons/logo_true.jpg" />
				</div>
				<div class="heading">
					<h1>Mojo</h1>
				</div>
			</a>
			<div class="user_profile_container">
				<a href="signin.php">Sign in</a>
			</div>
		</header>
		<div class="wrapper" align="center">
			<h2>Confirm Email</h2>
			<form action="includes/password_reset_token.php" method="POST">
				<label>
					<span>Enter your email</span>
					<input type="email" name="email" class="text" required="true" />
				</label>
				<input type="submit" name="submit" class="btn" value="Send Email Confirmation" />
			</form>
		</div>
	</body>
</html>
