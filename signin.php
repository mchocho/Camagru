<?php
require_once('includes/signin.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHeadTemplate("Sign In | Mojo");
    ?>
    <link rel="stylesheet" href="css/signin.css" media="all" />
  </head>
  <body>
    <!-- Render app header -->
    <?php
      include_once('includes/header.php');
    ?>
    <div class="wrapper" align="center">
      <!-- Render content -->
      <?php
        include_once('views/signin.php');
      ?>
    </div>
  </body>
</html>