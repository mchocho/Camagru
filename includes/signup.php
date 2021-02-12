<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]))
{
  ft_redirectuser();
  exit($msgs["errors"]["already_signed_in"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  if (!validateSignUp())
    exit(); 

  $username  = trim($_POST["username"]);
  $email     = trim($_POST["email"]);
  $password  = $_POST["password"];

  if (emailIsReserved($email))
  {
    ft_redirectuser(redirects("SIGN_UP_EMAIL_ALREADY_EXISTS") );
    exit();
  }

  if (usernameIsReserved($username))
  {
    ft_redirectuser(redirects("SIGN_UP_USERNAME_ALREADY_EXISTS") );
    exit();
  }

  $password  = hash_password($password);
  $user      = insertNewUser($username, $email, $password);
  
  if (!isset($user) )
  {
    ft_redirectuser(redirects("SIGN_UP_UNKOWN_ERROR") );
    exit();
  }

  $token    = generate_token();
  $tokenId  = insertNewRegistrationToken($user, $token["hash"]);

  if (isset($tokenId))
    sendVerificationEmail($user, $email, $token["key"]);

  ft_redirectuser(redirects("EMAIL_VERIFICATION_SENT") );
}