<?php
session_start();

require_once ('includes/ft_util.php');

stfu();

if (isset($_SESSION['username']) && isset($_SESSION['id']))
	ft_redirectuser();

?>
<!DOCTYPE html>
<html>
	<head>
		<?php
     HTMLHead("Sign In | Mojo");
    ?>
    <style>
      .wrapper {
        position: relative;
        top: -20px;
        border: 3px solid #DDDDDD;
        width: 40%;
        padding: 6%;
        border-radius: 13px;
      }
    </style>
	</head>
	<body>
		<!-- Render app header -->
    <?php
      require_once('includes/header.php');
    ?>

		<div class="wrapper" align="center">
			<h2>Sign In</h2>
			<form action="includes/signin.php" method="POST">
				<ul class="errors">
					<?php
						if (isset($_GET['error_1']))
							echo '<li>Please enter your username</li>';

						if (isset($_GET['error_2']))
							echo '<li>Please enter your password.</li>';

						if (isset($_GET['error_3']))
							echo '<li>Your email or password was incorrect.</li>';
					?>
				</ul>

				<label>
					<span>Username</span>
					<input type="text" name="username" class="text" />
				</label>
				<br />
				<label>
					<span>Password</span>
					<input type="password" name="password" class="text" />
				</label>
				<input type="submit" name="submit" value="Sign In" class="btn" />
			</form>
			<a href="reinit_password.php">Forgot Password? Click here</a>
		</div>
	</body>
</html>
