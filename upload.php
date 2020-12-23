<?php
require_once("includes/upload.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Render HTML head content -->
    <?php
      HTMLHeadTemplate("Image Uploads | Mojo");
    ?>
    <link rel="stylesheet" href="css/uploads.css" media="all" />
  </head>
  
  <body>
    <!-- Render app header -->
    <?php
      include_once("includes/header.php");
    ?>

    <div class="wrapper main settings"> 
      <?php
        include_once("views/upload.php");
      ?>
    </div>

    <!-- Display the app footer -->
    <?php
      include_once("views/footer.php");
    ?>

    <script src="js/xhr.js"     type="text/javascript"></script>
    <script src="js/uploads.js" type="text/javascript"></script>
  </body>
</html>
