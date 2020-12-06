<!-- Display the post -->
<div class="image_container">
  <?php
    echo HTML_IMG_POST;
  ?>
</div>

<!-- Display the author's usernane -->
<span class="props">
  <?php
    echo ATTRIBUTE;
  ?>
</span>

<div class="social_container">
  
  <!-- Display like or unlike action button -->
  <button id="like" name="like">
    <?php
      echo HTML_IMG_LIKE;
    ?>
  </button>

  <!-- Display the share button -->
  <button id="share" name="share">
    <img src="images/icons/share.png" alt="share icon" />
  </button>
</div>

<div class="comments_container">
  <hr />

  <span class="heading">Comments</span>

  <!-- Display comment count -->
  <span id="comment_count" class="count">
    <?php
      echo $comment_count;
    ?>
  </span>

  <span> | </span>

  <span class="heading">Likes </span>

  <!-- Display likes counts -->
  <span id="like_count" class="count">
    <?php
        echo $like_count;
    ?>
  </span>

  <hr />

  <!-- Display comment form -->
  <?php
    renderCommentForm();
  ?>

  <!-- Display comments for this post -->
  <ol class="comments" id="comment_list" >
    <?php 
      renderPostComments($comments);
    ?>
  </ol>
</div>