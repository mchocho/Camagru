<?php
require_once('sql.php');

$images = selectAllImages();

if (!is_array($images))
  exit();

$images = array_reverse($images); //Sort images from most recent to oldest

$i = 0;
$results_per_page = 8;            //You can change this based on screen size
$total = count($images);
$page_count = ceil($total / $results_per_page);

if (!isset($_GET["page"]))
  $page = 1;
else
  $page = (is_numeric($_GET['page'])) ? $_GET['page'] : 1;

$first_results = ($page - 1) * $results_per_page;

while($i < $results_per_page && $i < $total)
{
  if ($first_results > -1)
  {
    $image = $images[$first_results];

    echo '<a href="post.php?id='      . $image['id']   . '">';
    echo  '<img src="images/uploads/'  . $image['name'] . '" />';
    echo '</a>';
  }
  
  $first_results++;
  $i++;
}