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
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="manifest.webmanifest">
		<style>
			.content {
				width: 100%;
			}

			.icon {
				width: 90px;
				height: 90px;
			}
		</style>
		<link rel="stylesheet" href="css/style.css" media="all" />
	</head>
	<body>
		<div class="wrapper" align="center">
			<h2>A verification link has been sent to your email account</h2>
			<img class="icon" src="images/icons/envelope.png" alt="envelope image" />
			<div class="content">
				<p>Thanks for signing up. In order to start using Mojo, you need to confirm your email address.</p>
				<p>Please click on the link that has just been sent to your email account to continue</p>
			</div>
		</div>
	</body>
</html>