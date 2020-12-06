<?php
require_once("includes/post.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      HTMLHeadTemplate(TITLE);
    ?>
    <link rel="stylesheet" href="css/post.css" media="all" />
  </head>

  <body>
    <!-- Render app header -->
    <?php
      include_once("includes/header.php");
    ?>

    <div class="wrapper main settings" align="center">
      <?php
        include_once("views/post.php");
      ?>
    </div>
    
    <!-- Display the app footer -->
    <?php
      include_once("views/footer.php");
    ?>

    <script type="text/javascript">
  		document.addEventListener("DOMContentLoaded", function() {
  			const buttons = [
  				document.getElementById('like'),
  				document.getElementById('share'),
  				document.getElementById('delete'),
  				document.getElementById('comment_submit')
  			],
  			likeImage = document.getElementById('like-img'),
  			comment_form = document.getElementById('comment_form'),
  			comment_box = document.getElementById('comment'),
  			imageId = <?php
  					if (isset($result['id']))
  						echo "'" . $result['id'] . "';";
  					else
  						echo "null;";
  				?>


  			function xhr(url, method, form, onSuccess, onError) {
  				let xhr = new XMLHttpRequest();
  				xhr.open(method, url);
  				if (form instanceof FormData)
  					xhr.send(form);
  				else
  					xhr.send();
  				xhr.onload = function() {
  					console.log(xhr.status);
  				  if (xhr.status != 200) { // analyze HTTP status of the response
  				    // alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
  				    onError(xhr)
  				  } else { // show the result
  				    // alert(`Done, got ${xhr.response.length} bytes`); // responseText is the server
  				    onSuccess(xhr);
  				  }
  				};

  				/*xhr.onprogress = function(event) {
  				  if (event.lengthComputable) {
  				    alert(`Received ${event.loaded} of ${event.total} bytes`);
  				  } else {
  				    alert(`Received ${event.loaded} bytes`); // no Content-Length
  				  }

  				};*/

  				xhr.onerror = function() {
  				  alert("Request failed");
  				};
  			}

  			//Like button clicked
  			if (buttons[0] !== null) {
  				buttons[0].addEventListener('click', function() {
  					xhr('includes/likes.php?image_id=' + imageId, 'GET', null, function(xhr) {
  						console.log(xhr.responseText);
  						const result = JSON.parse(xhr.responseText),
  						     like_count = document.getElementById('like_count');
  						if (result.result === 'liked') {
  							likeImage.src = 'images/icons/like_red.png';
  							likeImage.classList.add('liked');
  							like_count.innerHTML = parseInt(like_count.innerHTML) + 1;
  						} else if (result.result === 'unliked') {
  							likeImage.src = 'images/icons/like.png';
  							likeImage.classList.remove('liked');
  							like_count.innerHTML = parseInt(like_count.innerHTML) - 1;
  						}
  					}, function(xhr) {
  						console.log(xhr.responseText);
  					});
  				});
  			}

  			//Text box event listener
  			comment_box.addEventListener('keyup', function() {
  				if (comment_box.value) {
  					buttons[3].removeAttribute('disabled');
  				} else {
  					buttons[3].setAttribute('disabled', 'true');
  				}
  			});

  		});
  	</script>
  </body>
</html>
