<?php
require_once("config.php");

function createFooter()
{
  $startYear = "2019";
  $thisYear  = date('Y');

  $footer	   = '<footer align="center">';
  $footer   .=  "&copy ";

  if ($startYear !== $thisYear)
    $footer	.=  $startYear ." - ";
  
  $footer   .=  $thisYear ." | " .APP_NAME;
  $footer   .= "</footer";

  return $footer;
}

function compose_email_verification_template($url)
{
  $msg = "<h1>Verify Your Email</h1>";
  $msg .= "<p>";
  $msg .=   "Please confirm that you want to use this email address for your Mojo account.";
  $msg .=   "Once it's done you will be able to start using this service.";
  $msg .= "</p>";
  $msg .= "<button>";
  $msg .=   '<a href="' . $url . '" target="_blank">';
  $msg .=     "Verify my email";
  $msg .=   "</a>";
  $msg .= "</button>";
  $msg .= "<p>";
  $msg .=   "Or copy and paste the link below into the your address bar";
  $msg .= "</p>";
  $msg .= $url;
  $msg .= "<br /><br />";
  $msg .= createFooter();
  
  return $msg;
}

function compose_reset_password_template($str)
{
  $msg  = "<h1>Hi There</h1>";
  $msg .= "<p>We received a request to reset your password for your Mojo account.</p>";
  $msg .= "<p>Simply click on the button below to set a new password:</p>";
  $msg .= "<button>";
  $msg .=   '<a href="' . $str . '" target="_blank">';
  $msg .=     "Reset my password";
  $msg .=   "</a>";
  $msg .= "</button>";
  $msg .= "<p>";
  $msg .=   "Or copy and paste the link below into the address bar";
  $msg .= "</p>";
  $msg .= $str;
  $msg .= "<br /><br />";
  $msg .= createFooter();

  return $msg;
}

function compose_comment_notification_template($username, $commenter, $url) {
  $msg  = '<h2>Hi' . $username . '</h2>';
  $msg .= "<p>$commenter has just commented on your post.</p><br />";
  $msg .= "<p>To view the post, click on the link below</p><br />";
  $msg .= '<a href=""' . $url . '</a>';
  $msg .= "<br /><br />";
  $msg .= createFooter();
 
  return $msg;
}