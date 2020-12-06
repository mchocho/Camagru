<?php

function stm($key)
{
  return array(
    "selUserById"                   => "SELECT * FROM `users` WHERE `id` = ?",
    "selUserNameById"               => "SELECT `username` FROM `users` WHERE `id` = ?",
    "selUserNameAndEmailById"       => "SELECT `username`, `email` FROM `users` WHERE `id` = ?",
    "selUserByNameOrEmail"          => "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?",
    "selUserByEmail"                => "SELECT * FROM `users` WHERE `email` = ?",
    "selUserIdByEmail"              => "SELECT `id` FROM `users` WHERE `email` = ?",
    "selUserIdByUsername"           => "SELECT `id` FROM `users` WHERE `username` = ?",
    "setNewPasswordByEmail"         => "UPDATE `users` SET `password` = ?  WHERE `email` = ?'",
    "setNewUserNameById"            => "UPDATE `users` SET `username` = ? WHERE `id` = ?", 
    "setNewUserEmailById"           => "UPDATE `users` SET `email` = ? WHERE `id` = ?",
    "setNewUserPasswordById"        => "UPDATE `users` SET `password` = ? WHERE `id` = ?",
    "setUserNotificationById"       => "UPDATE `users` SET `notifications` = ? WHERE `id` = ?",
    "selUserPassword"               => "SELECT `password` FROM `users` WHERE `id` = ?",
    "validateUserAccount"           => "UPDATE `users` SET `validated` = 'T'  WHERE `id` = ?",
    "insNewUser"                    => "INSERT INTO `users` (`username`, `email`, `password`) VALUES (?, ?, ?)",
    "insNewToken"                   => "INSERT INTO `tokens` (`user_id`, `token`, `request`) VALUES (?, ?, ?)",
    "selectTokenByValue"            => "SELECT * FROM `tokens` WHERE `token` = ?",
    "selAllImages"                  => "SELECT * FROM `images`",
    "selImageById"                  => "SELECT * FROM `images` WHERE `id` = ?",
    "selImagesByUserId"             => "SELECT * FROM `images` WHERE `user_id` = ?",
    "insNewImage"                   => "INSERT INTO images (`user_id`, `name`) VALUES (?, ?)",
    "delImageByIdAndUserId"         => "DELETE FROM `images` WHERE (`id` = ?) AND (`user_id` = ?)",
    "selAllCommentsByImageId"       => "SELECT * FROM `comment` WHERE `image_id` = ?",
    "selLikeIdAndUserByImageId"     => "SELECT `id`, `user_id` FROM `likes` WHERE `image_id` = ?",
    "insNewLike"                    => "INSERT INTO `likes` (`user_id`, `image_id`) VALUES (?, ?)",
    "delLikeByUserIdAndImageId"     => "DELETE FROM `likes` WHERE `user_id` = ? AND `image_id` = ?",
    "insNewComment"                 => "INSERT INTO `comment` (`user_id`, `image_id`, `message`) VALUES (?, ?, ?)"
  )[$key];
}

