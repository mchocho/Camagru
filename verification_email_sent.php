<?php 
require_once("includes/verification_email_sent.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHeadTemplate("Email Verification | Mojo");
    ?>
    <style>
      body {
        padding-top: 6%;
      }

      .content {
        width: 100%;
      }

      .icon {
        width: 90px;
        height: 90px;
      }
    </style>
  </head>

  <body>
    <div class="wrapper" align="center">

      <!-- Render content -->
      <?php
        include_once("views/verification_email_sent.php");
      ?>
    </div>
  </body>
</html>