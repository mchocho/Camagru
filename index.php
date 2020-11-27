<?php
require_once('includes/session_start.php');
?>

<!DOCTYPE html>
<html>
  <!-- Render HTML head contents -->
  <head>
    <?php
      HTMLHeadTemplate();
    ?>
  </head>

	<body class="index">
    <!-- Render app header -->
    <?php
      require_once('includes/header.php');
    ?>
    
    <div class="wrapper main" align="center">
      <div class="image_container" align="center">
        
        <div class="row" align="center">

          <!-- Render image layout -->
          <?php
            require_once('includes/gallery.php');
          ?>          
        </div>
        
        <!-- Render pagination links -->
        <?php
          require_once('includes/pagination.php');
        ?>
      </div>
    </div>
  </body>
</html>
