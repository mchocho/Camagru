<?php
require_once("session_start.php");

dev_mode();

if (!isset($_SESSION["id"]))
{
  ft_redirectuser();
  exit($msgs["errors"]["not_signed_in"]);
}

$redirect = redirects("UPLOAD");

if ($_SERVER["REQUEST_METHOD"] !== "GET")
{
  ft_redirectuser($redirect);
  exit($msgs["errors"]["invalid_request"]);
}

if (isset($_GET["image"]))
{
  $image_id = $_GET["image"];
  $user_id  = $_SESSION["id"];

  deleteImageByIdAndUserId($image_id, $user_id);
}

ft_redirectuser($redirect);
