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
      include_once('views/header.php');
    ?>
    <div class="wrapper" align="center">      
      <!-- Render content -->
      <?php
        include_once('views/signup.php');
      ?>
    </div>
  </body>
</html>

