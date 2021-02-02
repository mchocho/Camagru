<?php

$root = "../";

function redirects($key)
{
  return array(
    "SIGN_UP"                                   => $root ."signup.php",
    "SIGN_UP_EMAIL_ALREADY_EXISTS"              => $root ."signup.php?error_6=1",
    "SIGN_UP_USERNAME_ALREADY_EXISTS"           => $root ."signup.php?error_7=1",
    "SIGN_UP_UNKOWN_ERROR"                      => $root ."signup.php?error_8=1",
    "SIGN_IN"                                   => $root ."signin.php",
    "SIGN_IN_INCORRECT_CREDENTIALS"             => $root ."signin.php?error_3=1",
    "EMAIL_VERIFICATION_SENT"                   => $root ."verification_email_sent.php",
    "PASSWORD_RESET_EMAIL_SENT"                 => $root ."verification_email_sent.php?password_reset=1",
    "VERIFY_APP_TOKEN"                          => $root ."verify_token.php",
    "RESET_PASSWORD"                            => $root ."reset_password.php",
    "PASSWORD_RESET_NO_PASSWORD_PROVIDED"       => $root ."reset_password.php?error_1=1",
    "PASSWORD_RESET_NO_PASSWORD_CONFIRM"        => $root ."reset_password.php?error_2=1",
    "PASSWORD_RESET_PASSWORDS_PROVIDED_DIFFER"  => $root ."reset_password.php?error_3=1",
    "PASSWORD_RESET_WEAK_PASSWORD_PROVIDED"     => $root ."reset_password.php?error_4=1",
    "POST"                                      => $root ."post.php",
    "UPLOAD"                                    => $root ."upload.php",
    "UPLOAD_UNKNOWN_ERROR"                      => $root ."upload.php?error_1=1",
    "UPLOAD_NO_FILE_PROVIDED"                   => $root ."upload.php?error_2=1",
    "UPLOAD_INVALID_FILE_PROVIDED"              => $root ."upload.php?error_3=1",
    "UPLOAD_FILE_TOO_LARGE"                     => $root ."upload.php?error_4=1",
    "SETTINGS"                                  => $root ."settings.php",
    "SETTINGS_INCORRECT_PASSWORD"               => $root ."settings.php?error_1=1",
    "SETTINGS_NO_USERNAME_PROVIDED"             => $root ."settings.php?error_2=1",
    "SETTINGS_USERNAME_RESERVED"                => $root ."settings.php?error_3=1",
    "SETTINGS_UNKNOWN_ERROR"                    => $root ."settings.php?error_4=1",
    "SETTINGS_NO_PASSWORD_PROVIDED"             => $root ."settings.php?error_5=1",
    "SETTINGS_PASSWORDS_PROVIDED_DIFFER"        => $root ."settings.php?error_6=1",
    "SETTINGS_WEAK_PASSWORD_PROVIDED"           => $root ."settings.php?error_7=1"

  )[$key];
}

function params($key)
{
  return array(
    "NO_USERNAME_PROVIDED"                      => "error_1=1",
    "SIGN_UP_NO_EMAIL_PROVIDED"                 => "error_2=1",
    "SIGN_UP_NO_PASSWORD_PROVIDED"              => "error_3=1",
    "SIGN_UP_WEAK_PASSWORD_PROVIDED"            => "error_4=1",
    "SIGN_UP_PASSWORDS_PROVIDED_DIFFER"         => "error_5=1",
    "SIGN_IN_NO_PASSWORD_PROVIDED"              => "error_2=1"
  )[$key];
}