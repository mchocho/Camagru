<?php
require_once("session_start.php");
?>

<header>
  <a href="index.php" class="header">
    <div class="logo">
       <img src="images/icons/mojo.png" />
    </div>
    <div class="heading">
     <h1>Mojo</h1>
    </div>
  </a>

  <?php
    if (isset($_SESSION["id"], $_SESSION["username"]))
    {
      echo '<div class="user_profile_container settings" align="right">';
      echo   '<a href="upload.php">';
      echo     '<img src="images/mojo.jpg" class="profile_pic" />';
      echo   '</a>';
      echo   '<span class="username">' .$_SESSION["username"] .'</span>';
      echo   '<a href="includes/logout.php" class="logout">Log out</a>';
      echo '</div>';
    }
    else
    {
    	echo '<div class="auth">';
    	echo   '<a href="signup.php">Sign up</a> | <a href="signin.php">Sign in</a>';
    	echo '</div>';
    }
  ?>
</header>