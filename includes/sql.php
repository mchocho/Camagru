<?php
require('sql_connect.php');
require('sql_statements.php');

function selectUserById($id)
{
  return runSelectQuery($stm.selUserById, [$id]);
}

function selectUserNameById($id)
{
  return runSelectQuery($stm.selUserNameById, [$id]);
}

function selectUserNameAndEmailById($id)
{
  return runSelectQuery($stm.selUserNameAndEmailById, [$id]);
}

function selectUserByNameOrEmail($username, $email)
{
  return runSelectQuery($stm.selUserByNameOrEmail, [$username, $email]);
}

function selectUserByEmail($email)
{
  return runSelectQuery($stm.selUserByEmail, [$email]); 
}

function emailIsReserved($email)
{
  $result = runSelectQuery($stm.selUserIdByEmail, [$email]);

  if (!isset($result) )
    return false;

  return count($result) > 0;
}

function usernameIsReserved($username)
{
  $result = runSelectQuery($stm.selUserIdByUsername, [$username]);

  if (!isset($result) )
    return false;

  return count($result) > 0;
}

function insertNewUser($username, $email, $password)
{
  return runInsertQuery($stm.insNewUser, [$username, $email, $password]);
}

function insertNewRegistrationToken($userId, $hash)
{
  return runInsertQuery($stm.insNewToken, [$userId, $hash, "registration"]);
}

function insertNewPasswordResetToken($userId, $hash)
{
  return runInsertQuery($stm.insNewToken, [$userId, $hash, "password_reset"]);
}

function selectTokenByRef($key)
{
  return runSelectQuery($stm.selectTokenByValue, [$key]);
}

function validateUserAccount($userId)
{
  return runUpdateQuery($stm.validateUserAccount, [$userId]);
}

function selectAllImages()
{
  return runSelectQuery($stm.selAllImages);
}

function selectImageById($id)
{
  return runSelectQuery($stm.selImageById, [$id]);
}

function selectAllLikeIdsAndUsersByImageId($imageId)
{
  return runSelectQuery($stm.selAllLikeIdsAndUsersByImageId, [$imageId], true);
}

function selectAllCommentsByImageId($imageId)
{
  return runSelectQuery($stm.selAllCommentsByImageId, [$imageId], true);
}

function selectAllLikeIdsAndUsersByImageId($imageId)
{
  return runSelectQuery($stm.selLikeIdAndUserByImageId, [$imageId], true);
}

function deleteLikeByUserIdAndImageId($userId, $imageId)
{
  return runDeleteQuery($stm.delLikeByUserIdAndImageId, [$userId, $imageId]);
}

function insertNewLike($userId, $imageId)
{
  return runInsertQuery($stm.insNewLike, [$userId, $imageId]);
}

function insertNewComment($user_id, $image_id, $comment)
{
  return runInsertQuery($stm.insNewComment, [$user_id, $image_id, $message]);
}