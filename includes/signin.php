<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["already_signed_in"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  if (!validateSignIn())
    exit();

  $username = trim($_POST["username"]);
  $password = trim($_POST["password"]);
  $redirect = ROOT_PATH .redirects("SIGN_IN_INCORRECT_CREDENTIALS");

  $user = selectUserByNameOrEmail($username, $username);

  if (!isset($user))
  {
    ft_redirectuser($redirect);
    exit();
  }

  if (!iscorrectpassword($password, $user["password"]))
  {
    ft_redirectuser($redirect);
    exit();
  }

  if ($user["validated"] === 'F')
  {
    $_SESSION["email"]  = $user["email"];
    ft_redirectuser(ROOT_PATH .redirects("EMAIL_VERIFICATION_SENT") );
    exit();
  }

  $_SESSION["id"]             = $user["id"];
  $_SESSION["email"]          = $user["email"];
  $_SESSION["username"]       = $user["username"];
  $_SESSION["notifications"]  = $user["notifications"];
  $_SESSION["admin"]          = $user["admin"];

  ft_redirectuser(ROOT_PATH);
}
