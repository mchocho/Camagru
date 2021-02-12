<?php
require_once("session_start.php");

function handleNewComment($post_user, $image_id)
{
  $userSignedIn = isset($_SESSION["id"]);

  if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$userSignedIn)
    return;

  if (!isset($_POST["comment"], $_POST["submit"]))
    return;

  $comment  = $_POST["comment"];

  if (!insertNewComment($_SESSION["id"], $image_id, $comment))
    return;

  if ($post_user["notifications"] === "T")
  {
    $url      = current_path() . "/../post.php?id=$image_id";
    $title    = $_SESSION["username"] . " commented on your post!";
    $template = compose_comment_notification_template($post_user["username"], $_SESSION['username'], $comment, $url);

    email_client($post_user["email"], $title, $template);
  }
}

function renderCommentForm()
{
  $userSignedIn      = isset($_SESSION["id"]);
  $disabledAttribute = (!$userSignedIn) ? 'disabled="disabled"' : "";

  if (!$userSignedIn)
    return;

  echo '<form method="POST" id="comment_form">';
  echo   '<textarea id="comment" name="comment" placeholder="Add a comment" ' . $disabledAttribute . ' align="center"></textarea>';
  echo   '<input type="submit" id="comment_submit" name="submit" class="btn" value="Post" disabled="disabled"/>';
  echo '</form>';
}

function renderPostComments($comments)
{
  if (!isset($comments))
    return;

  $userSignedIn = isset($_SESSION["id"]);

  foreach ($comments as $comment)
  {
    $user = selectUserNameById($comment["user_id"]);

    if (!isset($user))
      continue;

    $username = $user["username"];
    $comment  = htmlspecialchars($comment["message"]);
    
    if ($userSignedIn)
      if ($username === $_SESSION["username"])
        $username = "You";

    $html  = "<li>";
    $html .=   '<span class="username">' . $username . '</span>';
    $html .=   "<blockquote>$comment</<blockquote>";
    $html .= "</li>";

    echo $html;
  }
}