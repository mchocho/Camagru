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
	    <!-- Use inline css -->
	    <style>

.row {
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
  margin: auto;
}

img {
  width: 400px;
  height: 400px;
}

/* Create four equal columns that sits next to each other */
.column {
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
  margin: auto;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

.wrapper a {
  position: unset !important;
  display: flex-inline;
}

.wrapper a img {
  /*margin: auto;*/
} 

.wrapper.main {

}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    flex: 100%;
    max-width: 100%;
  }
}
</style>
	    <!-- Or link external file -->
        <link rel="stylesheet" href="css/style.css" media="all" />
	</head>
	<body>
		<!-- Content goes here -->
    <header class="header">
      <a href="index.php">
        <div class="logo">
          <img src="images/icons/logo_true.jpg" />
        </div>
        <div class="heading">
          <h1>Mojo</h1>
        </div>
      </a>
      <?php
      require ('includes/profile_header.php');
      ?>
    </header>
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

            while($i < $results_per_page && $result[$first_results]) {
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
