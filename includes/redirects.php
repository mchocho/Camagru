<?php

function redirects($key)
{
  return array(
    "SIGN_UP"                                   => "signup.php",
    "SIGN_UP_EMAIL_ALREADY_EXISTS"              => "signup.php?error_6=1",
    "SIGN_UP_USERNAME_ALREADY_EXISTS"           => "signup.php?error_7=1",
    "SIGN_UP_UNKOWN_ERROR"                      => "signup.php?error_8=1",
    "SIGN_IN"                                   => "signin.php",
    "SIGN_IN_INCORRECT_CREDENTIALS"             => "signin.php?error_3=1",
    "EMAIL_VERIFICATION_SENT"                   => "verification_email_sent.php",
    "PASSWORD_RESET_EMAIL_SENT"                 => "verification_email_sent.php?password_reset=1",
    "VERIFY_APP_TOKEN"                          => "verify_token.php",
    "RESET_PASSWORD"                            => "reset_password.php",
    "PASSWORD_RESET_NO_PASSWORD_PROVIDED"       => "reset_password.php?error_1=1",
    "PASSWORD_RESET_NO_PASSWORD_CONFIRM"        => "reset_password.php?error_2=1",
    "PASSWORD_RESET_PASSWORDS_PROVIDED_DIFFER"  => "reset_password.php?error_3=1",
    "PASSWORD_RESET_WEAK_PASSWORD_PROVIDED"     => "reset_password.php?error_4=1",
    "POST"                                      => "post.php",
    "UPLOAD"                                    => "upload.php",
    "UPLOAD_UNKNOWN_ERROR"                      => "upload.php?error_1=1",
    "UPLOAD_NO_FILE_PROVIDED"                   => "upload.php?error_2=1",
    "UPLOAD_INVALID_FILE_PROVIDED"              => "upload.php?error_3=1",
    "UPLOAD_FILE_TOO_LARGE"                     => "upload.php?error_4=1",
    "SETTINGS"                                  => "settings.php"
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