<?php
require_once('includes/ft_util.php');
require_once('includes/sql_connect.php');
scream();
ft_session_start();
if (!isset($_GET['key']) || isset($_SESSION['id']))
	ft_redirectuser('index.php');

try {
	$q      = 'SELECT * FROM tokens WHERE token = ?';
	$result = $dbc->prepare($q);
	$result->execute([$_GET['key']]);
	$token = $result->fetch(PDO::FETCH_ASSOC);
	// $time   = strtotime($result['date_created']);
	// $now    = new DateTime("now");

	if (isset($result)) {
		// ft_echo("Welcome back please reset your password");
		$q      = 'SELECT * FROM users WHERE id = ?';
		$result = $dbc->prepare($q);
		$result->execute([$token['user_id']]);
		$result = $result->fetch(PDO::FETCH_ASSOC);

		$_SESSION['email'] = $result['email'];

		$q      = 'DELETE FROM tokens WHERE token = ?';
		$result = $dbc->prepare($q);
		$result->execute([$_GET['key']]);
		
	}
} catch (PDOException $e) {
	// echo "Error: ".$e->getMessage();
	// $errors[] = "Your email or password was incorrect.";
	ft_print_r($e);
	die();
	//In reality you should just redirect user back to index
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Reset Password | Camagru</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="manifest.webmanifest">
		<!-- Use inline css -->
		<!-- <style></style> -->
		<!-- Or link external file -->
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
			<?php 
				require_once('includes/profile_header.php');
			?>
		</header>
		<div class="wrapper" align="center">
			<h2>Reset Password</h2>
			<form action="includes/reset_user_password.php" method="POST">
				<label>
					<span>New Password</span>
					<input type="password" name="password" required="true" class="text" />
				</label>
				<br />
				<label>
					<span>Confirm Password</span>
					<input type="password" name="password_confirm" required="true" class="text" />
				</label>
				<input type="submit" name="submit" value="Sign In" class="btn" />
			</form>
		</div>
	</body>
</html>