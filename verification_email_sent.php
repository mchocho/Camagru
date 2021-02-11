<?php 
require_once("includes/verification_email_sent.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHeadTemplate("Email Verification | Mojo");
    ?>
    <link rel="stylesheet" href="css/verification_email_sent.css" media="all" />
  </head>

  <body>
    <div class="wrapper" align="center">
      <!-- Render app header -->
      <?php
        include_once("views/header.php");
      ?>

      <!-- Render content -->
      <?php
        include_once("views/verification_email_sent.php");
      ?>
    </div>
  </body>
</html>