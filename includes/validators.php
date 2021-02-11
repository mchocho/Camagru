<?php
require_once("redirects.php");
require_once("ft_util.php");

dev_mode();

function validateSignUp()
{
  $errors     = array();
  $url        = redirects("SIGN_UP") .'?';

  //Validate username
  if (!isset($_POST["username"]) )
    $errors[] = params("NO_USERNAME_PROVIDED");

  //Validate email
  if (!isset($_POST["email"]) )
  	$errors[] = params("SIGN_UP_NO_EMAIL_PROVIDED");
  else if (!isemail($_POST["email"]) )
    $errors[] = params("SIGN_UP_NO_EMAIL_PROVIDED");

  //Validate password
  if (!isset($_POST["password"]))
    $errors[] = params("SIGN_UP_NO_PASSWORD_PROVIDED");
  else if (!isstrongpassword($_POST["password"]))
    $errors[] = params("SIGN_UP_WEAK_PASSWORD_PROVIDED");
  else if ($_POST["password"] != $_POST["confirm_password"])
    $errors[] = params("SIGN_UP_PASSWORDS_PROVIDED_DIFFER");

  if (!empty($errors))
    return true;

  foreach($errors as $value)
    $url .= $value . '&';

  ft_redirectuser($url);

  return false;
}

function validateSignIn()
{
  $errors = array();
  $url    = redirects("SIGN_IN") .'?';

  //Validate username
  if (!isset($_POST['username']) )
    $errors[] = params("NO_USERNAME_PROVIDED");

  //Validate password
  if (!isset($_POST['password']) )
    $errors[] = params("SIGN_IN_NO_PASSWORD_PROVIDED");

  if (empty($errors))
    return true;

  foreach($errors as $value)
    $url .= $value .'?';

  ft_redirectuser($url);
 
  return false;
}

function sendVerificationEmail($user, $email, $key)
{
  $title    = "Email verification | " .APP_NAME;
  $url      = current_path() .redirects("VERIFY_APP_TOKEN") ."?key=$key";
  $template = compose_email_verification_template($url);

  if (!isset($key))
    email_client($email, $title, $template);
}

function validatePasswordReset()
{
  if (!isset($_POST["password"]))
  {
    ft_redirectuser(redirects("PASSWORD_RESET_NO_PASSWORD_PROVIDED") );
    return false;
  }
  else if (!isset($_POST["password_confirm"]))
  {
    ft_redirectuser(redirects("PASSWORD_RESET_NO_PASSWORD_CONFIRM") );
    return false;
  }
  else if ($_POST["password"] !== $_POST["password_confirm"])
  {
    ft_redirectuser(redirects("PASSWORD_RESET_PASSWORDS_PROVIDED_DIFFER") );
    return false;
  }
  else if (!isstrongpassword($_POST["password"]))
  {
    ft_redirectuser(redirects("PASSWORD_RESET_WEAK_PASSWORD_PROVIDED") );
    return false;
  }
}