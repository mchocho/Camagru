<?php

function renderstickers()
{
  $stickers = array(
  "empty",        "mojo",           "mojo_1",     "mojo_2", 
  "hey",          "lowkey_dog",     "sexy_dog",   "sad_dog",
  "cool_dog",     "dog_overlay",    "dinosaur",   "thinking",
  "donald_trump", "donald_trump_1", "food",       "money",
  "aliengrid",    "chestburster",   "empty"
  );

  foreach ($stickers as $sticker)
    echo '<img class="thumbnail" src="images/stickers/' .$sticker .'.png"/>';
}

function renderimages($images)
{
  foreach($images as $image)
  {
    echo '<div class="img"><img class="item" src="images/uploads/' .$image['name'] . '" />';
    echo   '<a href="includes/remove_post.php?image=' .$image['id'] .'">';
    echo     '<button type="submit" value="' .$image['id'] .'" >Delete</button>';
    echo   '</a>';
    echo '</div>';
  }
}