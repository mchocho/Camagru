<?php 
session_start();

require_once ('includes/ft_util.php');

stfu();

if (isset($_SESSION['id']))
	ft_redirectuser('index.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<?php
     HTMLHeadTemplate("Email Verification | Mojo");
    ?>
		<style>
      body {
        padding-top: 6%;
      }

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

      <!-- Render content -->
      <?php
        require_once('views/email_verification_sent.php');
      ?>
		</div>
	</body>
</html>