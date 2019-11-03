<?php
require('ft_util.php');
scream();

if (isset($_SESSION['username'])) {
	echo '<div class="user_profile_container settings" align="right">';
	echo '<img src="images/mojo.jpg" class="profile_pic" />';
	echo '<span class="username">' . $_SESSION['username'] . '</span>';
	echo '<a href="includes/logout.php" class="logout">Log out</a>';
	echo '</div>';
} else {
	echo '<div class="user_profile_container">';
	echo '<a href="signup.php">Sign up</a> | <a href="signin.php">Sign in</a>';
	echo '</div>';
}