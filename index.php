<?php
session_start();
require_once('includes/ft_util.php');
require_once('includes/getimages.php');
scream();
// require('getimages.php');
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
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
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
      <div class="image_container">
        <div class="row">
          <!-- <div class="column">
            <img src="images/uploads/wedding.jpg">
            <img src="images/uploads/rocks.jpg">
            <img src="images/uploads/falls2.jpg">
            <img src="images/uploads/paris.jpg">
            <img src="images/uploads/nature.jpg">
            <img src="images/uploads/mist.jpg">
            <img src="images/uploads/paris.jpg">
          </div>
          <div class="column">
            <img src="images/uploads/wedding.jpg">
            <img src="images/uploads/rocks.jpg">
            <img src="images/uploads/falls2.jpg">
            <img src="images/uploads/paris.jpg">
            <img src="images/uploads/nature.jpg">
            <img src="images/uploads/mist.jpg">
            <img src="images/uploads/paris.jpg">
          </div>
          <div class="column">
            <img src="images/uploads/wedding.jpg">
            <img src="images/uploads/rocks.jpg">
            <img src="images/uploads/falls2.jpg">
            <img src="images/uploads/paris.jpg">
            <img src="images/uploads/nature.jpg">
            <img src="images/uploads/mist.jpg">
            <img src="images/uploads/paris.jpg">
          </div> -->

          <!-- <div class="column"> -->
          <?php
            $i = 0;

            $total = count($result);
            $results_per_page = 4;
            $page_count = ceil($total / $results_per_page);

            if (!isset($_GET['page']))
              $page = 1;
            else
              $page = (is_numeric($_GET['page'])) ? $_GET['page'] : 1;

            $first_results = ($page - 1) * $results_per_page;

            try {
              $q = 'SELECT id, name FROM images LIMIT ' . $first_results . ',' . $results_per_page;
              $result = $dbc->prepare($q);
              $result->execute();
              $result = $result->fetchAll(PDO::FETCH_ASSOC);

              foreach($result as $key => $value) {
                echo '<a href="post.php?id=' . $value['id'] . '"><img src="images/uploads/' . $value['name'] . '" /></a>';
              }

              // if ($total > 0)
                // echo '<div>/';
            } catch (PDOException $err) {
              ft_echo("Something went wrong");
            }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
