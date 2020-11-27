<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["already_signed_in"]);
}