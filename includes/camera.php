<?php
require_once("session_start.php");

dev_mode();

if (!isset($_SESSION["id"]))
{
  exit($msgs["response"]["not_signed_in"]);
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
  if (empty($_FILES))
  {
    exit($msgs["response"]["no_picture_provoded"]);
  }
  else if (!isset($_FILES["file"]))
  {
    exit($msgs["response"]["no_picture_provoded"]);
  }

  $file         = $_FILES["file"];
  $tmp          = $file["tmp_name"];
  $mime         = "png";

  if ($file["error"] !== 0)
    exit($msgs["response"]["image_upload_failed"]);
  else if ($file["size"] > MAX_UPLOAD_SIZE)
    exit($msgs["response"]["image_upload_file_too_large"]);

  $filename     = uniqid();
  $directory    = ROOT_PATH ."images/uploads/";

  $newfile      = $filename .'.' .$mime;
  $destination  = $directory .$newfile;

  ft_makedir($directory);

  if (!move_uploaded_file($tmp, $destination))
    exit($msgs["response"]["image_upload_failed"]);

  $id = saveNewImage($_SESSION["id"], $newfile);

  if (!is_string($id))
  {
    unlink($destination);
    exit($msgs["response"]["image_upload_failed"]);
  }

  exit('{"image": "' . $id . '" }');
}