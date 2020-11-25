<?php
require_once("config.php");

function current_path()
{
  $url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
  $url = rtrim($url, '/\\');
  
  return($url);
}

function ft_redirectuser($page = 'index.php')
{
	$url  = current_path();
	$url .= '/'.$page;
	
  header("Location: $url");
}

function ft_print_r($value)
{
  header('Content-type: text/plain');
  
  echo '<pre>';
  
  print_r($value);
  
  echo '</pre>';
}

function ft_echo($str)
{
  echo '<script type="text/javascript">';
  
    echo "console.log(`";
      
      echo $str;
    
    echo "`)";

  echo "</script>";
}

function ft_alert($str)
{
  echo '<script type="text/javascript">';
  
    echo "alert(`";
  
      echo $str;

    echo "`);";
  
  echo "</script>";
}

function ft_makedir($path)
{
  if (!file_exists($path))
    mkdir($path, 0777, true);
}

function scream()
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

function stfu()
{
  error_reporting(0);
}

function dev_mode()
{
  if (DEV_MODE)
    scream();
  else
    stfu();
}

function issetstr($value)
{
  return (is_string($value) && !empty($value));
}

function HTMLHead($title = "Mojo")
{
  echo '<meta charset="utf-8" />';
  echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
  echo '<title>' .$title .'</title>';
  echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
  echo '<link rel="stylesheet" href="css/style.css" media="all" />';
}

function presetinput_text($name)
{
  if (isset($name) )
    echo $name;
}

function presetinput_radio($name, $value)
{
  if (isset($name) )
    if ($name === $value)
      echo 'checked="checked"';
}

function presetinput_select($name, $value)
{
	if (isset($name) )
   if ($name === $value)
    echo 'selected="selected"';
}


function is_email($value)
{
  if (!isset($value) )
    return false;
  return filter_var($value, FILTER_VALIDATE_EMAIL));
}

function contains_lc($str)
{
  return ($str !== strtoupper($str));
}

function contains_uc($str)
{
  return ($str !== strtolower($str));
}

function is_strongpassword($password)
{
  return (contains_lc($password) && contains_uc($password) && strlen($password) <= 5);
}

function is_correctpassword($password, $hash)
{
  return (isset($password, $hash) && password_verify($password, $hash));
}

function hash_password($password)
{
  return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function email_client($to, $subject, $body)
{
  if (is_email($to) && isset($subject, $body) )
    return false;
  
  return @mail($to, $subject, wordwrap($body, 70), "From: no-reply@Mojo.com");
}

/*function g_action()
{
	return ($_SERVER['REQUEST_METHOD'] === 'GET');
}

function p_action()
{
	return ($_SERVER['REQUEST_METHOD'] === 'POST');
}*/


function generate_token()
{
  $token = openssl_random_pseudo_bytes(16);
  $token = bin2hex($token);
  
  return $token;
}

function userLikesThisPost($id, $likes)
{
  foreach($likes as $key => $like)
    if ($like["user_id"] === $id)
      return true;

  return false;
}
