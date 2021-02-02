<?php
$startYear 	= "2019";
$thisYear 	= date('Y');
?>

<footer>
  <div align="center">
    <div>
      Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a>
      |
      <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a>
    </div>

    <p>
      Made by <a href="https://github.com/mchocho">mchocho</a> with <span class="hrt">&#10084;</span>
    </p>

    <p>
      &copy; 
      <?php
        if ($startYear !== $thisYear)
          echo $startYear ." - ";
        echo $thisYear ." | " .APP_NAME;
      ?>
    </p>
  </div>
</footer>