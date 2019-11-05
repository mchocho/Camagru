<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['username'])) {
	echo '<div class="user_profile_container settings" align="right">';
	echo '<a href="post.php"><img src="images/mojo.jpg" class="profile_pic" /></a>';
	echo '<span class="username"><a href="settings.php">' . $_SESSION['username'] . '</a></span>';
	echo '<a href="includes/logout.php" class="logout">Log out</a>';
	echo '</div>';
} else {
	echo '<div class="user_profile_container">';
	echo '<a href="signup.php">Sign up</a> | <a href="signin.php">Sign in</a>';
	echo '</div>';
}