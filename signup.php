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
	    <title>Sign Up | Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style.css" media="all" />
	</head>
	<body>
		<!-- Content goes here -->
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
			<h2>Sign Up</h2>
			<form action="includes/registration.php" method="POST">
				<ul class="errors">
					<?php 
						if (isset($_GET['error_1']))
							echo '<li>Please enter your username</li>';

						if (isset($_GET['error_2']))
							echo '<li>Please enter your email address.</li>';

						if (isset($_GET['error_3']))
							echo '<li>The passwords provided don\'t match.</li>';

						if (isset($_GET['error_4']))
							echo '<li>Please enter a password of 5 characters. Use uppercase && lowercase.</li>';

						if (isset($_GET['error_5']))
							echo '<li>Please enter your password</li>';

						if (isset($_GET['error_6']))
							echo '<li>Email already exists</li>';

						if (isset($_GET['error_7']))
							echo '<li>Username already exists.</li>';

						if (isset($_GET['error_8']))
							echo '<li>Something went wrong. Please try again</li>';
					?>
				</ul>
				<label>
					<span>Username</span>
					<input type="text" name="username" required="true" class="text" />
				</label>
				<br />
				<label>
					<span>Email</span>
					<input type="email" name="email" required="true" class="text" />
				</label>
				<br />
				<label>
					<span>Password</span>
					<input type="password" name="password" required="true" class="text" />
				</label>
				<br />
				<label>
					<span>Confirm Password</span>
					<input type="password" name="password2" required="true" class="text" />
				</label>
				<br />
				<input type="submit" name="submit" value="Sign Up" class="btn" />
			</form>
		</div>
	</body>
</html>

