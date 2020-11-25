<?php
require_once("session_start.php");

dev_mode();

function validateSignUp()
{
	$errors = array();
  $url    = ROOT_PATH ."/signup.php?";

  //Validate username
  if (!isset($_POST["username"]) )
  	$errors[] = $params["NO_USERNAME_PROVIDED"];

  //Validate email
  if (!isset($_POST["email"]) )
  	$errors[] = $params["SIGN_UP_NO_EMAIL_PROVIDED"];
  else if (!is_email($_POST["email"]) )
    $errors[] = $params["SIGN_UP_NO_EMAIL_PROVIDED"];

  //Validate password
  if (!isset($_POST["password"]))
  	$errors[] = $params["SIGN_UP_NO_PASSWORD_PROVIDED"];
  else if (!is_strongpassword($_POST["password"]))
		$errors[] = $params["SIGN_UP_WEAK_PASSWORD_PROVIDED"];
	else if ($_POST["password"] != $_POST["confirm_password"])
    $errors[] = $params["SIGN_UP_PASSWORDS_PROVIDED_DIFFER"];

  if (!empty($errors))
  	return true;

  $url = '?';

  foreach($errors as $value)
  	$url .= $value . '&';

  ft_redirectuser($url);
}

function validateSignIn()
{
  $errors = array();
  $url    = ROOT_PATH .$redirects["SIGN_IN"];

  //Validate username
  if (!isset($_POST['username']) )
    $errors[] = $params["NO_USERNAME_PROVIDED"];

  //Validate password
  if (!isset($_POST['password']) )
    $errors[] = $params["SIGN_IN_NO_PASSWORD_PROVIDED"];

  if (empty($errors))
    return true;

  foreach($errors as $value)
    $url .= $value . '&';

  ft_redirectuser($url);
 
  return false;
}

function sendVerificationEmail($id, $email)
{
  $key      = hash("sha256", date_timestamp_get(date_create()));
  $hash     = hash_password($hash);                                //Encrypt the hash and use encoded value as the reference

  $tokenId  = createRegistrationToken($user, $hash);
  
  $title    = "Email verification | " .APP_NAME;
  $url      = current_path() .ROOT_PATH .$redirects["VERIFY_APP_TOKEN"] ."?key=$key";
  $template = compose_email_verification_template($url);

  if (!isset($tokenId))
    email_client($email, $title, $template);
}

function validatePasswordReset()
{
  if (!isset($_POST["password"]))
  {
    //"Please enter a new password."
    ft_redirectuser($redirects["PASSWORD_RESET_NO_PASSWORD_PROVIDED"]);
    return false;
  }
  else if (!isset($_POST["password_confirm"]))
  {
    // echo "Please confirm your new password.";
    ft_redirectuser($redirects["PASSWORD_RESET_NO_PASSWORD_CONFIRM"]);
    return false;
  }
  else if ($_POST["password"] !== $_POST["password_confirm"])
  {
    // echo "The passwords provided don't match.";
    ft_redirectuser($redirects["PASSWORD_RESET_PASSWORDS_PROVIDED_DIFFER"]);
    return false;
  }
  else if (!is_strongpassword($_POST["password"]))
  {
    ft_redirectuser($redirects["PASSWORD_RESET_WEAK_PASSWORD_PROVIDED"]);
    return false;
    
  }
}