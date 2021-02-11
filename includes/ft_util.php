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
  if (getenv("DEV"))
    scream();
  else
    stfu();
}

function issetstr($value)
{
  return (is_string($value) && !empty($value));
}

function HTMLHeadTemplate($title = "Mojo")
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


function isemail($value)
{
  if (!isset($value) )
    return false;
  return filter_var($value, FILTER_VALIDATE_EMAIL);
}

function contains_lc($str)
{
  return ($str !== strtoupper($str));
}

function contains_uc($str)
{
  return ($str !== strtolower($str));
}

function isstrongpassword($password)
{
  return (contains_lc($password) && contains_uc($password) && strlen($password) <= 5);
}

function iscorrectpassword($password, $hash)
{
  return (isset($password, $hash) && password_verify($password, $hash));
}

function hash_password($password)
{
  return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function email_client($to, $subject, $body)
{
  if (isemail($to) && isset($subject, $body) )
    return false;
  
  return @mail($to, $subject, wordwrap($body, 70), "From: no-reply@Mojo.com");
}

function userLikesThisPost($id, $likes)
{
  foreach($likes as $key => $like)
    if ($like["user_id"] === $id)
      return true;

  return false;
}

function generate_token()
{
  $key      = hash("sha256", date_timestamp_get(date_create()));
  $hash     = hash_password($key);

  return array(
    "key"  => $key,
    "hash" => $hash
  );
}

function getimagetype($file)
{
  $info = new finfo(FILEINFO_MIME_TYPE);

  return (explode("/",strtolower($info->buffer(file_get_contents($file))))[1]);
}


function isvalidimage($file)
{
  $allowed  = array("jpg", "jpeg", "gif", "png", "tif");
  $filetype = getimagetype($file);

  foreach ($allowed as $key => $type)
    if ($type === $filetype)
      return true; 

  return false;

}
