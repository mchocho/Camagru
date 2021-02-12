<?php
require_once("session_start.php");

dev_mode();

if (!isset($_SESSION["id"]))
{
  ft_redirectuser();
  exit($msgs["errors"]["not_signed_in"]);
}


if ($_SERVER["REQUEST_METHOD"] === "POST")
{

  if (!isset($_GET["option"]))
  {
    ft_redirectuser(redirects("SETTINGS"));
    exit($msgs["errors"]["invalid_requst"]);
  }

  $id       = $_SESSION["id"];
  $option   = $_GET["option"];
  $password = selectUserPassword($id);

  if (!isset($password))
  {
    ft_redirectuser(redirects("SETTINGS"));
    exit();
  }

  if ($option !== "profile" && $option !== "notifications")
  {
    if (!isset($_POST["password"]))
      ft_redirectuser(redirects("SETTINGS_NO_PASSWORD_PROVIDED"));
    elseif (!iscorrectpassword($_POST["password"], $password["password"]))
      ft_redirectuser(redirects("SETTINGS_INCORRECT_PASSWORD"));

    exit();
  }

  switch($option)
  {
    case "profile":
      //TODO

      break;
    case "username":
      if (!isset($_POST["username"]))
      {
        ft_redirectuser(redirects("SETTINGS_NO_USERNAME_PROVIDED"));
        exit();
      }

      $username = $_POST["username"];

      if (usernameIsReserved($username))
      {
        ft_redirectuser(redirects("SETTINGS_USERNAME_RESERVED"));
        exit();
      }
      else if (!setNewUserNameById($username, $id))
      {
        ft_redirectuser(redirects("SETTINGS_UNKNOWN_ERROR"));
        exit();
      }

      $_SESSION["username"] = $username;

      break;
    case "email":
      if (!isset($_POST["email"]))
      {
        ft_redirectuser(redirects("SETTINGS_NO_EMAIL_PROVIDED"));
        exit();
      }
      else if (!isemail($_POST["email"]))
      {
        ft_redirectuser(redirects("SETTINGS_NO_EMAIL_PROVIDED"));
        exit();
      }

      $email = $_POST["email"];

      if (emailIsReserved($email))
      {
        ft_redirectuser(redirects("SETTINGS_EMAIL_RESERVED"));
        exit();
      }
      else if (!setNewUserEmailById($email, $id))
      {
        ft_redirectuser(redirects("SETTINGS_UNKNOWN_ERROR"));
        exit();
      }

      $_SESSION["email"] = $email;

      break;
    case "password":
      if (!isset($_POST["newpassword"], $_POST["confirm"]))
      {
        ft_redirectuser(redirects("SETTINGS_NO_PASSWORD_PROVIDED"));
        exit();
      }

      $newpassword = $_POST["newpassword"];
      $confirm     = $_POST["confirm"];

      if ($newpassword !== $confirm)
      {
        ft_redirectuser(redirects("SETTINGS_PASSWORDS_PROVIDED_DIFFER"));
        exit();
      }
      else if (!isstrongpassword($newpassword))
      {
        echo $newpassword;
        exit();

        ft_redirectuser(redirects("SETTINGS_WEAK_PASSWORD_PROVIDED"));
        exit(); 
      }
      else if (!setNewUserPasswordById($newpassword, $id))
      {
        ft_redirectuser(redirects("SETTINGS_NO_PASSWORD_PROVIDED"));
        exit();
      }

      break;
    case "notifications":
      if (!isset($_POST['notifications']) )
      {
        ft_redirectuser(redirects("SETTINGS"));
        exit();
      }

      $request       = $_POST["notifications"] === "on";
      
      $notifications = $_SESSION["notifications"] === 'T';
      $newvalue      = $notifications ? 'F' : 'T';

      if (!(($request && $notifications) || (!$request && !$notifications) ) )
        if (!setUserNotification($newvalue, $id))
        {
          ft_redirectuser(redirects("SETTINGS_UNKNOWN_ERROR"));
          exit();
        }

      $_SESSION["notifications"]  = $newvalue;

      break;
    default: break;
  }

  ft_redirectuser(redirects("SETTINGS"));
}

$username               = $_SESSION["username"];
$email                  = $_SESSION["email"];
$notifications_enabled  = $_SESSION["notifications"] === "T";

$notification           = ($notifications_enabled) ? "enabled"           : "disabled";
$class_attribute        = ($notifications_enabled) ? ""                  : "off";
$submit_value           = ($notifications_enabled) ? "off"               : "on";


$notification_icon      = '<button type="submit" class="opac" name="notifications" value="' .$submit_value .'" >';
$notification_icon     .=   '<div class="icon slider '.$class_attribute .'"></div>';
$notification_icon     .= "</button>";

define("USER",                     "<p>Your current username is <span>" .$username ."</span></p>");
define("EMAIL",                    "<p>Your current email address is <span>" .$email ."</span></p>");
define("NOTIFICATIONS",            "<p>Notifications are currently " .$notification ."</p>");
define("HTML_ICON_NOTIFICATIONS",  $notification_icon);