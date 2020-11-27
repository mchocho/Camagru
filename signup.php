<?php
require_once("includes/signup.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHeadTemplate("Sign Up | Mojo");
    ?>
  </head>
  <body>
    <?php
      require_once('includes/header.php');
    ?>
    <div class="wrapper" align="center">      
      <!-- Render content -->
      <?php
        require_once('views/signup.php');
      ?>
    </div>
  </body>
</html>

