<?php
require_once("./config.php");

function createConnection()
{
  try
  {
    $db   = getenv("DB");
    $user = getenv("USERNAME");
    $pass = getenv("PASSWORD");

  	$dbc = new PDO($db, $user, $pass);
  	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $dbc;
  }
  catch (PDOException $e)
  {
  	echo "Connection failed: ".$e->getMessage();
  }
}

function runSelectQuery($stm, $values, $fetchAll = false)
{
	try
  {
    $dbc    = createConnection();

    $result = $dbc->prepare($stm);
    $result->execute($values);
    $result = ($fetchAll) ? $result->fetchAll() : $result->fetch(PDO::FETCH_ASSOC);

    return $result;
  }
  catch (PDOException $e)
  {
    if (DEV_MODE)
    {
      ft_echo($e->getMessage());
      ft_alert(ALERT_ERROR);
    }

    return NULL;
  }
}

function runInsertQuery($stm, $values)
{
  try
  {
    $dbc    = createConnection();

    $result = $dbc->prepare($stm);
    $result->execute($values);
    $value  = $dbc->lastInsertId();

    return $value;  //Returns the insert id
  }
  catch (PDOException $e)
  {
    if (DEV_MODE)
    {
      ft_echo($e->getMessage());
      ft_alert(ALERT_ERROR);
    }

    return false;
  }
}

function runUpdateQuery($stm, $values)
{
  try
  {
    $dbc    = createConnection();

    $result = $dbc->prepare($stm);
    $result->execute($values);

    return true;  //Returns the insert id
  }
  catch (PDOException $e)
  {
    if (DEV_MODE)
    {
      ft_echo($e->getMessage());
      ft_alert(ALERT_ERROR);
    }

    return false;
  }
}

function runDropQuery($stm, $values)
{
  try
  {
    $dbc    = createConnection();
    
    $result = $dbc->prepare($stm);
    $result->execute($values);

    return true;
  }
  catch (PDOException $e)
  {
    if (DEV_MODE)
    {
      ft_echo($e->getMessage());
      ft_alert(ALERT_ERROR);
    }

    return false;
  }
}
