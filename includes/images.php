<?php
  require_once('getimages.php');

  $i = 0;
  $results_per_page = 8;      //You can change this based on screen size
  $total = count($result);
  $page_count = ceil($total / $results_per_page);

  if (!isset($_GET['page']))
    $page = 1;
  else
    $page = (is_numeric($_GET['page'])) ? $_GET['page'] : 1;

  $first_results = ($page - 1) * $results_per_page;

  while($i < $results_per_page)
  {
    if ($first_results > -1)
    {
      echo '<a href="post.php?id='      . $result[$first_results]['id']   . '">';
      echo '<img src="images/uploads/'  . $result[$first_results]['name'] . '" /></a>';
    }

    $first_results++;
    $i++;
  }