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

	if (isset($result)) {
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
	ft_redirectuser('index.php');
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