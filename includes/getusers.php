<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]))
{
  $user = selectUserById($_SESSION["id"]);

  if (isset($user))
  {
    $_SESSION["username"] = $user["username"];
    $_SESSION["id"]       = $user["id"];
    $_SESSION["email"]	  = $user["email"];
    $_SESSION["admin"]    = $user["admin"];
  }
}