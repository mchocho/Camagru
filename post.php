<?php
require_once("includes/post.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      HTMLHeadTemplate(TITLE);
    ?>
    <link rel="stylesheet" href="css/post.css" media="all" />
  </head>

  <body>
    <!-- Render app header -->
    <?php
      include_once("includes/header.php");
    ?>

    <div class="wrapper main post" align="center">
      <?php
        include_once("views/post.php");
      ?>
    </div>
    
    <!-- Display the app footer -->
    <?php
      include_once("views/footer.php");
    ?>

    <script src="js/xhr.js"  type="text/javascript"></script>
    <script src="js/post.js" type="text/javascript"></script>
  </body>
</html>
