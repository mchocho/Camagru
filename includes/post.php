<?php
require_once("session_start.php");
require_once("comments.php");

dev_mode();

if (!isset($_GET["id"]))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["unkown-post"]);
}

$userSignedIn  = isset($_SESSION["id"]);
$image         = selectImageById($_GET["id"]);

if (!isset($image))
{
  ft_redirectuser(ROOT_PATH);
  exit($msgs["errors"]["unkown-post"]);
}

$post_user     = selectUserNameAndEmailById($image["user_id"]);   //Get details of post author

$likes         = selectAllLikeIdsAndUsersByImageId($image["id"]); //Get the post likes and users details for this post
$like_count    = (is_array($likes)) ? count($likes) : 0;

$comments      = selectAllCommentsByImageId($image["id"]);
$comment_count = (is_array($comments)) ? count($comments) : 0; 

$likeIconSrc   = "images/icons/like.png";                         //Assume user does not like post

if ($userSignedIn)
  if (userLikesThisPost($_SESSION["id"], $likes))
    $likeIconSrc = "images/icons/like_red.png";


if ($_SERVER["REQUEST_METHOD"] === "POST" && $userSignedIn)
  handleNewComment($post_user["id"], $image["id"]);

define("TITLE",         $post_user["username"] ."'s post | Mojo");
define("HTML_IMG_POST", '<img src="images/uploads/' .$image["name"] . '" />');
define("HTML_IMG_LIKE", '<img src="' .$likeIconSrc .'" id="like_img" alt="like icon" />');
define("ATTRIBUTE", "   Posted by "  .$post_user["username"]);