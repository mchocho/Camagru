<?php
require_once("session_start.php");

dev_mode();

if (isset($_SESSION["id"]) )
{
  ft_redirectuser(ROOT_APP);
  exit($msgs["errors"]["already_signed_in"]);
}


if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
  if (!isset($_POST["submit"], $_POST["email"])) 
    exit($msgs["errors"]["invalid_request"]);

  if (!is_email($_POST["email"]))
  {
    // ft_redirectuser(ROOT_APP);
    exit("Please enter a valid email address.");
  }

  $user = selectUserByEmail($_POST["email"]);

  if (!isset($user))
    exit(); //Email address does not exist, revealing this info is a security risk

  $user_id  = $user["id"];
  $email    = $user["email"];


  $key      = hash('sha256', date_timestamp_get(date_create()));
  $hash     = hash_password($key);

  $tokenId  = insertNewPasswordResetToken($user_id, $hash);
  

  $title    = "Reset Password | " .APP_NAME;
  $url      = current_path() .ROOT_PATH .$redirects["VERIFY_APP_TOKEN"] ."?key=$key";
  $template = compose_reset_password_template($url);

  if (isset($tokenId))
    email_client($email, $title, $template);

		echo "A verification message has been sent to your email address.";
	} else {
		echo "Something went wrong";
	}
}