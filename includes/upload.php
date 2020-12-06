<?php
require_once("session_start.php");

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

$stickers = array(
  "empty",        "mojo",           "mojo_1",     "mojo_2", 
  "hey",          "lowkey_dog",     "sexy_dog",   "sad_dog",
  "cool_dog",     "dog_overlay",    "dinosaur",   "thinking",
  "donald_trump", "donald_trump_1", "food",       "money",
  "aliengrid",    "chestburster",   "empty"
);

function renderstickers($stickers)
{
  foreach ($stickers as $sticker)
    echo '<img class="thumbnail" src="images/stickers/' $sticker '.png" onclick="addSup(this)"/>';
}

function renderimages($images)
{
  foreach($images as $key => $image)
  {
    echo '<div class="img"><img class="item" src="images/uploads/' .$image['name'] . '" />';
    echo   '<a href=includes/remove_post.php?image=' .$image['id'] .'>';
    echo     '<button type="submit" value="' .$image['id'] .'" >Delete</button>';
    echo   '</a>';
    echo '</div>';
  }
}