<?php
require_once("session_start.php");
require_once('email_templates.php');

handleNewComment($post_user_id, $image_id)
{
  $userSignedIn = isset($_SESSION["id"]);

  if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$userSignedIn)
    return;

  if (!isset($_POST["comment"], $_POST["submit"]))
    return;

  $comment  = $_POST["comment"];

  if (!insertNewComment($post_user_id, $image_id, $comment))
    return;

  if ($post_user["notifications"] === "T")
  {
    $url      = current_path() ."/../post.php?id=$image_id";
    $title    = $_SESSION["username"] ." commented on your post!";
    $template = compose_comment_notification_template($post_user["username"], $_SESSION['username'], $url);

    email_client($post_user["email"], $title, $template);
  }
}