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

$post_user = $post_user["username"];

function renderCommentForm()
{
  $userSignedIn      = isset($_SESSION["id"]);
  $disabledAttribute = (!$userSignedIn)        ? 'disabled="disabled"' : "";

  if (!$userSignedIn)
    return;

  echo '<form method="POST" id="comment_form">';
  echo   '<textarea id="comment" name="comment" placeholder="Add a comment" ' .$disabledAttribute ."></textarea>";
  echo   '<input type="submit" id="comment_submit" name="submit" class="btn" value="Post" disabled="disabled"/>';
  echo '</form>';
}


function renderPostComments($comments)
{
  if (!isset($comments))
    return;

  foreach ($comments as $comment)
  {
    $user = selectUserNameById([$comment["user_id"]]);

    if (!isset($user))
      continue;

    $username = $user["username"];
    $comment  = htmlspecialchars($comment["message"]);
    
    if (isset($_SESSION["username"]))
      if ($username === $_SESSION["username"])
        $username = "You";

    $html  = "<li>";
    $html .=    '<span class="username">' . $username . '</span>';
    $html .=    "<blockquote>$comment</<blockquote>";
    $html .= "</li>";

    echo $html;
  }
}