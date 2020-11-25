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
  if (!validateSignUp())
    exit(); 

  $username  = trim($_POST["username"]);
  $email     = trim($_POST["email"])
  $password  = $_POST["password"];

  if (emailIsReserved($email))
  {
		ft_redirectuser(ROOT_PATH .redirects["SIGN_UP_EMAIL_ALREADY_EXISTS"]);
    exit();
  }

  if (usernameIsReserved($username))
  {
    ft_redirectuser(ROOT_PATH .redirects["SIGN_UP_USERNAME_ALREADY_EXISTS"]);
    exit();
	}

  $password  = hash_password($password);
  $id        = insertNewUser($username, $email, $password);
  
  if (!isset($id) )
  {
    ft_redirectuser(ROOT_PATH .redirects["SIGN_UP_UNKOWN_ERROR"]);
    exit();
  }

  sendVerificationEmail($id, $email);

	ft_redirectuser(ROOT_PATH .redirects["EMAIL_VERIFICATION_SENT"]);
}