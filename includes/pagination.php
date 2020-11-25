<?php 

if (isset($page_count))
{
    $page_i = 1;

    while ($page_i <= $page_count)
    {
      if ($page_i != 1)
        echo ' | ';
      
      echo '<a href="index.php?page=' . $page_i . '">' . $page_i . '</a>';
      $page_i++;
    }
}