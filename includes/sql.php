<?php
require_once("sql_statements.php");
require_once("sql_connect.php");

function selectUserById($userId)
{
  return runSelectQuery(stm("selUserById"), [$userId]);
}

function selectUserNameById($userId)
{
  return runSelectQuery(stm("selUserNameById"), [$userId]);
}

function selectUserNameAndEmailById($userId)
{
  return runSelectQuery(stm("selUserNameAndEmailById"), [$userId]);
}

function selectUserByNameOrEmail($username, $email)
{
  return runSelectQuery(stm("selUserByNameOrEmail"), [$username, $email]);
}

function selectUserByEmail($email)
{
  return runSelectQuery(stm("selUserByEmail"), [$email]);
}

function emailIsReserved($email)
{
  $result = runSelectQuery(stm("selUserIdByEmail"), [$email], true);

  if (!isset($result) )
    return false;

  return count($result) > 0;
}

function usernameIsReserved($username)
{
  $result = runSelectQuery(stm("selUserIdByUsername"), [$username], true);

  if (!isset($result) )
    return false;

  return count($result) > 0;
}

function insertNewUser($username, $email, $password)
{
  return runInsertQuery(stm("insNewUser"), [$username, $email, $password]);
}

function insertNewRegistrationToken($userId, $hash)
{
  return runInsertQuery(stm("insNewToken"), [$userId, $hash, "registration"]);
}

function insertNewPasswordResetToken($userId, $hash)
{
  return runInsertQuery(stm("insNewToken"), [$userId, $hash, "password_reset"]);
}

function setUserPasswordByEmail($password, $email)
{
  return runUpdateQuery(stm("setNewPasswordByEmail"), [$password, $email]);
}

function setNewUserNameById($username, $userId)
{
  return runUpdateQuery(stm("setNewUserNameById"), [$username, $userId]);
}

function setNewUserEmailById($email, $userId)
{
  return runUpdateQuery(stm("setNewUserEmailById"), [$email, $userId]);
}

function setNewUserPasswordById($password, $userId)
{
  return runUpdateQuery(stm("setNewUserPasswordById"), [$password, $userId]);
}

function setUserNotification($value, $userId)
{
  return runUpdateQuery(stm("setUserNotificationById", [$value, $userId]));
}

function selectTokenByRef($key)
{
  return runSelectQuery(stm("selectTokenByValue"), [$key]);
}

function validateUserAccount($userId)
{
  return runUpdateQuery(stm("validateUserAccount"), [$userId]);
}

function selectAllImages()
{
  return runSelectQuery(stm("selAllImages"), [], true);
}

function selectImageById($imageId)
{
  return runSelectQuery(stm("selImageById"), [$imageId]);
}

function selectUserPassword($userId)
{
  return runSelectQuery(stm("selUserPassword"), [$userId]);
}

function selectAllUserImages($userId)
{
  return runSelectQuery(stm("selImagesByUserId"), [$userId], true);
}

function saveNewImage($userId, $file)
{
  return runInsertQuery(stm("insNewImage"), [$userId, $file]);
}

function deleteImageByIdAndUserId($imageId, $userId)
{
  return runDropQuery(stm("delImageByIdAndUserId"), [$imageId, $userId]);
}

function selectAllCommentsByImageId($imageId)
{
  return runSelectQuery(stm("selAllCommentsByImageId"), [$imageId], true);
}

function selectAllLikeIdsAndUsersByImageId($imageId)
{
  return runSelectQuery(stm("selLikeIdAndUserByImageId"), [$imageId], true);
}

function deleteLikeByUserIdAndImageId($userId, $imageId)
{
  return runDropQuery(stm("delLikeByUserIdAndImageId"), [$userId, $imageId]);
}

function insertNewLike($userId, $imageId)
{
  return runInsertQuery(stm("insNewLike"), [$userId, $imageId]);
}

function insertNewComment($userId, $imageId, $comment)
{
  return runInsertQuery(stm("insNewComment"), [$userId, $imageId, $message]);
}

function dropDB()
{
  echo stm("dropDB").'\n';

  return runDropQuery(stm("dropDB"), []);
}