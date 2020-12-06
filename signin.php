<?php
require_once('includes/signin.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHeadTemplate("Sign In | Mojo");
    ?>
    <style>
      .wrapper {
        position: relative;
        top: -20px;
        border: 3px solid #DDDDDD;
        width: 40%;
        padding: 6%;
        border-radius: 13px;
      }
    </style>
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