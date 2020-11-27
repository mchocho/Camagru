<?php
require_once("includes/forgot_password.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <?php
      HTMLHeadTemplate("Confirm Email | Mojo");
    ?>
  </head>

  <body>
    <!-- Render app header -->
    <?php
      require_once("includes/header.php");
    ?>

    <div class="wrapper" align="center">
    
      <!-- Render content -->
      <?php
        require_once("views/forgot_password.php");
      ?>
    </div>
  </body>
</html>
