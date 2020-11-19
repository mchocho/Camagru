<?php
require_once ('includes/ft_util.php');

ft_session_start();
stfu();

if (isset($_SESSION['username']) || isset($_SESSION['id']))
{
	ft_redirectuser();
	return;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<?php
      HTMLHead("Confirm Email | Mojo");
    ?>
	</head>
	<body>
		<!-- Render app header -->
		<?php
      require_once('includes/header.php');
    ?>

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
