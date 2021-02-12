<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]))
{
  ft_redirectuser();
  exit($msgs["errors"]["already_signed_in"]);
}

if ($_SERVER["REQUEST_METHOD"] !== "GET" || !isset($_GET["key"]))
{
  ft_redirectuser();
  exit($msgs["errors"]["invalid_request"]);
}

$key        = $_GET["key"];
$encodedkey = hash_password($key);
$token      = selectTokenByRef($encodedkey);

if (!isset($token))
{
  ft_redirectuser();
  exit();
}

$id       = $token["user_id"];
$request  = $token["request"];

//TODO Delete the token

switch($request)
{
	
  case "registration":
    validateUserAccount($id));

    $redirect = redirects("SIGN_IN");

    ft_redirectuser($redirect);
    break;
  case "password_reset":
    $user_id  = selectUserById($id);

    if (!isset($user_id))
      ft_redirectuser();

    $_SESSION["email"] = $user["email"];

    $redirect = redirects("RESET_PASSWORD");

    ft_redirectuser($redirect);
    break;
}