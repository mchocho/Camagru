<?php
session_start();
require_once('includes/ft_util.php');
// stfu();
scream();
?>

<!DOCTYPE html>
<html>
  <?php
    HTMLHead("Camagru");
  ?>
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
            require_once('includes/images.php');
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
