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

			if (isset($_GET["error_4"]))
				echo "<li>Something went wrong. Please try again.</li>";
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

<a href="forgot_password.php">Forgot Password? Click here</a>