#!/bin/php

<?php
require_once("../config.php");
require_once("../includes/sql_statements.php");

try
{
  $dbc = new PDO(DB, USERNAME, PASSWORD);
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Dropping Camagru DB...\n";

  $result = $dbc->prepare(stm("dropDB"));
  $result->execute();

  echo "Goodbye Mojo.";
}
catch (PDOException $e)
{
  echo "Connection failed: ".$e->getMessage();
}