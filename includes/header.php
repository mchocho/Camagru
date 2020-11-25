<?php
//Move this file to the views folder
require_once("session_start.php");
?>

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
    if (isset($_SESSION['username']))
    {
      echo '<div class="user_profile_container settings" align="right">';
      echo   '<img src="images/mojo.jpg" class="profile_pic" />';
      echo   '<span class="username">' .$_SESSION['username'] .'</span>';
      echo   '<a href="includes/logout.php" class="logout">Log out</a>';
      echo '</div>';
    }
    else
    {
    	echo '<div class="user_profile_container">';
    	echo    '<a href="signup.php">Sign up</a> | <a href="signin.php">Sign in</a>';
    	echo '</div>';
    }
  ?>
</header>