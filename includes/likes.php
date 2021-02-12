<?php
require_once("session_start.php");

dev_mode();

if ($_SERVER["REQUEST_METHOD"] !== "GET")
  exit($msgs["response"]["invalid_request"]);

if (!isset($_SESSION["id"]) )
  exit($msgs["response"]["not_signed_in"]);

if (!isset($_GET["image_id"]) )
  exit($msgs["response"]["invalid_request"]);

$userId     = $_SESSION["id"];
$imageId    = $_GET["image_id"];

$likes      = selectAllLikeIdsAndUsersByImageId($imageId);

$likeCount  = (is_array($likes) ) ? count($likes) : 0;

$response   = array(
  "liked"   => '{"result": "unliked", "count": ' .$likeCount .'};',
  "unliked" => '{"result": "liked",   "count": ' .$likeCount .'};'
);

if (userLikesThisPost($userId, $likes) )                //The request is to unlike
{
  if (deleteLikeByUserIdAndImageId($userId, $imageId) )
    exit($response["unliked"]);
  else
    exit($response["liked"]);
}
else    //The requst is to like the image
{
  if (insertNewLike($userId, $imageId) )
    exit($response["liked"]);
  else
    exit($response["unliked"]);
}