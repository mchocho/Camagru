<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["already_signed_in"]);
}

if (!isset($_SESSION["email"]))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["invalid_request"]);
}
else if (!isemail($_SESSION["email"]))
{
  session_destroy();

  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["invalid_request"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  if (!validatePasswordReset())
    exit($msgs["errors"]["invalid_request"]);

  $email    = $_SESSION["email"];
  $password = hash_password($_POST["password"]);

  setUserPasswordByEmail($password, $email);
  session_destroy();

  ft_redirectuser(ROOT_PATH .redirects("SIGN_IN") );
}