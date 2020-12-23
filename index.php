<?php
require_once('includes/session_start.php');
?>

<!DOCTYPE html>
<html>
  <!-- Render HTML head content -->
  <head>
    <?php
      HTMLHeadTemplate();
    ?>
  </head>

	<body class="index">
    <!-- Render app header -->
    <?php
      include_once("includes/header.php");
    ?>
    
    <div class="wrapper main" align="center">
      <?php
        include_once("views/index.php");
      ?>
    </div>
  </body>
</html>
