<?php 
session_start();

require_once ('includes/ft_util.php');

stfu();

if (isset($_SESSION['username']) || isset($_SESSION['id']))
	ft_redirectuser();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
     HTMLHead("Email Verification | Mojo");
    ?>
		<style>
			.content {
				width: 100%;
			}

			.icon {
				width: 90px;
				height: 90px;
			}
		</style>
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