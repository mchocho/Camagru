<?php
require_once("config.php");

$startYear 	= "2019";
$thisYear 	= date('Y');
?>

<footer>
  <p>
  	&copy; 
  	<?php
      if ($startYear !== $thisYear)
        echo $startYear ." - ";
      echo $thisYear ." | " .APP_NAME;
    ?>
  <p>

  <p>
    Made by <a href="https://github.com/mchocho">mchocho</a> with <span class="hrt">&#10084;</span>
  </p>

  <div>
    Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
  </div>
</footer>