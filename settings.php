<?php
require ("includes/settings.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
     HTMLHead("Settings | Mojo");
    ?>
    <link rel="stylesheet" href="css/settings.css" media="all" />
  </head>

  <body>
    <!-- Render app header -->
    <?php
      include_once("includes/header.php");
    ?>

    <div class="wrapper main settings" align="center">
      <?php
        include_once("views/settings.php");
      ?>
    </div>

    <!-- Display the app footer -->
    <?php
      include_once("views/footer.php");
    ?>

    <script src="js/xhr.js"      type="text/javascript"></script>
    <script src="js/settings.js" type="text/javascript"></script>
  </body>
</html>