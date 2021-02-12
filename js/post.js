document.addEventListener("DOMContentLoaded", script);

function script()
{
  const likeBtn      = document.getElementById("like");
  const commentForm  = document.getElementById("comment_form");
  const commentInput = document.getElementById("comment");

  function updateLikeStatus(res)
  {
    console.log(JSON.stringify(res));

    const result    = JSON.parse(res.responseText);
    const likes     = document.getElementById("like_count");
    const likeImg   = document.getElementById("like_img");
    const likeCount = parseInt(likes.innerHTML);


    if (result.result === "liked")
    {
      console.log("WTF");

      likes.innerHTML = likeCount + 1;
      likeImg.src     = "images/icons/like_red.png";
      likeImg.classList.add("liked");
    }
    else if (result.result === "unliked")
    {
      console.log("REALLY");

      likes.innerHTML = likeCount - 1;
      likeImg.src     = "images/icons/like.png";
      likeImg.classList.remove("liked");
    }
  }

  function likeUpdateFailed()
  {

  }

  function onLikeBtnClicked(e)
  {
    const urlParams = new URLSearchParams(window.location.search);
    const imageId   = urlParams.get("id");
    
    const url       = `includes/likes.php?image_id=${imageId}`;

    xhr(url, null, "GET")
    .then(updateLikeStatus)
    .catch(likeUpdateFailed);
  }

  //Like button clicked
  if (likeBtn !== null)
    likeBtn.addEventListener("click", onLikeBtnClicked);

  function onCommentKeyUp(e)
  {
    const submitBtn = document.getElementById("comment_submit");

    if (commentInput.value)
      submitBtn.removeAttribute("disabled");
    else
      submitBtn.setAttribute("disabled", "true");
  }

  //Text box event listener
  if (commentInput)
    commentInput.addEventListener("keyup", onCommentKeyUp);
}