<?php
require_once("session_start.php");
require_once("stickers.php");

dev_mode();

if (!isset($_SESSION["id"]))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["not_signed_in"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  if (!isset($_POST["submit"]))
  {
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD"));
    exit($msgs["errors"]["invalid_requst"]);
  }
  else if (empty($_FILES))
  {
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD_NO_FILE_PROVIDED") );
    exit();
  }
  else if (!isset($_FILES["file"]))
  {
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD_NO_FILE_PROVIDED") );
    exit();
  }

  $file         = $_FILES["file"];
  $tmp          = $file["tmp_name"];

  if ($file["error"] !== 0)
  {
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD_UNKNOWN_ERROR"));
    exit();
  }
  else if ($file["size"] < MAX_UPLOAD_SIZE)
  {
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD_FILE_TOO_LARGE"));
    exit();
  }
  else if (!getimagesize($tmp) || !isvalidimage($tmp))
  {
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD_INVALID_FILE_PROVIDED"));
    exit();
  }

  $filename     = uniqid();
  $directory    = ROOT_PATH ."images/uploads/";
  $mime         = getimagetype($tmp);

  $newfile      = $filename .'.' .$mime;
  $destination  = $directory .$newfile;

  move_uploaded_file($tmp, $destination)

  if (!saveNewImage($_SESSION["id"], $newfile))
  {
    unlink($destination);
    ft_redirectuser(ROOT_PATH .redirects("UPLOAD_UNKNOWN_ERROR");
    exit();
  }
}

$images = selectAllUserImages($_SESSION["id"]);

if (isset($images))
  array_reverse($images);