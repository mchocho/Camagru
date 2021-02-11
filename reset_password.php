<?php
require_once("includes/reset_password.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      HTMLHeadTemplate("Reset Password | Mojo");
    ?>
  </head>

  <body>
    <?php
      include_once("views/header.php");
    ?>

    <div class="wrapper" align="center">
      <?php
        include_once("views/reset_password.php");
      ?>
    </div>
  </body>
</html>