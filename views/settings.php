<h2>Settings</h2>

<div class="settings_container">
  <ul class="errors">
    <?php
      if (isset($_GET['error_1']))
        echo '<li>Please enter your username</li>';

      if (isset($_GET['error_2']))
        echo '<li>Please enter your password.</li>';

      if (isset($_GET['error_3']))
        echo '<li>Your password was incorrect.</li>';

      if (isset($_GET["error_4"]))
        echo "<li>Something went wrong. Please try again.</li>";
      
      if (isset($_GET["error_5"]))
        echo "<li>Please enter your password.</li>";
      
      if (isset($_GET["error_6"]))
        echo "<li>The passwords provided don't match.</li>";
      
      if (isset($_GET["error_7"]))
        echo "<li>Please enter a password of 8 characters. Use uppercase & lowercase.</li>";
    ?>
  </ul>


  <?php
    require_once("profile_picture.php");
    require_once("new_username.php");
    require_once("new_email.php");
    require_once("new_password.php");
    require_once("notifications.php");
  ?>    

</div>