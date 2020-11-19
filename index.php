<?php
session_start();
require_once('includes/ft_util.php');
require_once('includes/getimages.php');
stfu();
?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Camagru</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/style.css" media="all" />
	</head>
	<body class="index">
    <!-- Render app header -->
    <?php
      require('includes/header.php');
    ?>
    
    <div class="wrapper main" align="center">
      <div class="image_container" align="center">
        <div class="row" align="center">
          <?php
            $i = 0;
            $total = count($result);
            $results_per_page = 8;
            $page_count = ceil($total / $results_per_page);

            if (!isset($_GET['page']))
              $page = 1;
            else
              $page = (is_numeric($_GET['page'])) ? $_GET['page'] : 1;

            $first_results = ($page - 1) * $results_per_page;

            while($i < $results_per_page) {
              if ($first_results > -1)
                echo '<a href="post.php?id=' . $result[$first_results]['id'] . '"><img src="images/uploads/' . $result[$first_results]['name'] . '" /></a>';
              $first_results++;
              $i++;
            }
          ?>
        </div>
        <?php 
          // if (isset($page_count)) {
              $page_i = 1;

              while ($page_i <= $page_count) {
                if ($page_i != 1)
                  echo ' | ';
                echo '<a href="index.php?page=' . $page_i . '">' . $page_i . '</a>';
                $page_i++;
              }
          // }
        ?>
      </div>
    </div>
  </body>
</html>
