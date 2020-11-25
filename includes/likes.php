<?php
require_once("session_start.php");
require_once("sql.php");
require_once("messages.php");
require_once("ft_util.php");

dev_mode();

if ($_SERVER["REQUEST_METHOD"] !== "GET")
  exit($msgs["errors"]["invalid_request"]);

if (!isset($_SESSION["id"]) )
  exit($msgs["errors"]["not_signed_in"]);

if (!isset($_GET["image_id"]) )
  exit($msgs["errors"]["invalid_request"]);

$userId     = $_SESSION["id"];
$imageId    = $_GET["image_id"];

$likes      = selectAllLikeIdsAndUsersByImageId($imageId);

$likeCount  = (is_array($likes) ) ? count($likes) : 0;

$response  	= array(
  "liked"   => '{"result": "unliked", "count": ' . $likeCount . ' }',
  "unliked" => '{"result": "liked", "count": ' . $likeCount . '}'
);

if (userLikesThisPost($userId, $imageId) )                //The request is to unlike
  (deleteLikeByUserIdAndImageId($userId, $imageId) ) ? echo response["unliked"] : echo response["liked"];
else                                                      //The requst is to like the image
  (insertNewLike($userId, $imageId) ) ? echo response["liked"] : echo response["unliked"];