#!/bin/php

<?php
require("../config.php");

try
{
  $dbc        = new PDO(DB_INIT, USERNAME, PASSWORD);
  $file       = file_get_contents("./setup.sql");
  $statements = explode(';', $file);
  
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Creating Camagru DB...\n";

  foreach($statements as $i => $statement)
  {
    $stm = trim(preg_replace('/\s\s+/', ' ', $statement)); //Remove all newlines

    if (empty($stm) || $i === sizeof($statements) - 1)
      continue;

    $result = $dbc->prepare($stm);
    $result->execute();
  }

  echo "Camagru DB created.\n";
}
catch (PDOException $e)
{
  echo "Connection failed: ".$e->getMessage();
}

?>
