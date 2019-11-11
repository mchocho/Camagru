<?php
session_start();
require('includes/ft_util.php');
require('includes/sql_connect.php');
require('includes/getusers.php');
scream();

if (!isset($_GET['id']))
	ft_redirectuser();

try {
	$q      = "SELECT * FROM images WHERE (id = ?)";
	$result = $dbc->prepare($q);
	$result->execute([$_GET['id']]);
	$result = $result->fetch(PDO::FETCH_ASSOC);

	if (!isset($result))
		ft_redirectuser();

	$q      = "SELECT username, email FROM users WHERE (id = ?)";
	$p_user = $dbc->prepare($q);
	$p_user->execute([$result['user_id']]);
	$p_user = $p_user->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
	ft_echo($e->getMessage());
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $p_user['username'] . "'s POST"; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="manifest.webmanifest">
		<link rel="stylesheet" href="css/style.css" media="all" />
		<link rel="stylesheet" href="css/post.css" media="all" />
	</head>
	<body>
		<!-- Content goes here -->
		<header class="header">
			<a href="index.php">
				<div class="logo">
					<img src="images/icons/logo_true.jpg" />
				</div>
				<div class="heading">
					<h1>Mojo</h1>
				</div>
			</a>
			<?php
			  require ('includes/profile_header.php');
			?>
		</header>
		<div class="wrapper main settings" align="center">
			<div class="image_container">
				<?php
					echo '<img src="images/uploads/' . $result['name'] . '" />';
				?>
			</div>
			<span class="props">Posted by <?php echo $p_user['username']; ?></span>
			<div class="social_container">
					<?php
						if (isset($_SESSION['id'])) {
							try {
								$q = "SELECT id FROM likes WHERE (user_id = ?) AND (image_id = ?)";
								$like = $dbc->prepare($q);
								$like->execute([$_SESSION['id'], $_GET['id']]);
								$like = $like->fetch(PDO::FETCH_ASSOC);

								$q	    = "SELECT id FROM likes WHERE (image_id = ?)";
								$like_count = $dbc->prepare($q);
								$like_count->execute([$_GET['id']]);
								$like_count = $like_count->fetchAll();
								$like_count = count($like_count);

								echo '<button id="like" name="like">';
								if (is_array($like))
									echo '<img src="images/icons/like_red.png" id="like-img" alt="like icon" />';
								else
									echo '<img src="images/icons/like.png" id="like-img" alt="like icon" />';
								echo '</button>';
							} catch (PDOException $e) {
								ft_echo($e->getMessage());
							}
						}

					?>
				<button id="share" name="share">
					<img src="images/icons/share.png" alt="share icon" />
				</button>
			</div>
			<div class="comments_container">
				<?php 
					try {
						$q      = "SELECT * FROM comment WHERE (image_id = ?)";
						$comments = $dbc->prepare($q);
						$comments->execute([$_GET['id']]);
						$comments = $comments->fetchAll();
						$comment_count = count($comments);
					} catch (PDOException $e) {
						ft_echo($e->getMessage());
					}
				?>
				<hr />
				<span class="heading">Comments</span>
				<span id="comment_count" class="count">
					<?php
						if (isset($comment_count))
							echo $comment_count;
						else echo "0";
					?>
				</span>
				<span> | </span>
				<span class="heading">Likes</span>
				<span id="like_count" class="count">
					<?php
						if (isset($like_count))
							echo $like_count;
						else echo "0";
					?>
				</span>
				<hr />
				<form method="POST" action="includes/comments.php" id="comment_form" >
					<textarea id="comment" name="comment" placeholder="Add a comment" <?php if (!isset($_SESSION['id'])) echo 'disabled="disabled"'; ?> ></textarea>
					<input type="submit" id="comment_submit" name="submit" class="btn" value="Post" disabled="disabled"/>
					<?php echo '<input type="hidden" id="image" name="image" value="' . $_GET['id'] . '" />'; ?>
				</form>
				<ol class="comments" id="comment_list" >
					<?php 
						if (isset($comments)) {	
							foreach ($comments as $key => $value) {
								try {
									$q      = "SELECT username FROM users WHERE (id = ?)";
									$user = $dbc->prepare($q);
									$user->execute([$value['user_id']]);
									$user = $user->fetch(PDO::FETCH_ASSOC);

									$username = $user['username'];
									if (isset($_SESSION['username']) && $_SESSION['username'] === $user['username'])
										$username = 'You';


									$html = '<li><span class="username">' . $username . '</span>';
									$html .= '<blockquote>' . htmlspecialchars($value['message']) . '</<blockquote></li>';

									echo $html;
								}  catch (PDOException $e) {
									ft_echo($e->getMessage());
								}
							}
						}
					?>
				</ol>
			</div>
		</div>
		<footer>
			<div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
		</footer>
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
							} else {
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

				//Comment submit button
				/*buttons[3].addEventListener('click', function() {
					const formData = new FormData(comment_form),
						  comment_list = document.getElementById('comment_list');
					
					//formData.append('image_id', document.getElementById('image_id').value);
					xhr('includes/comments.php', 'POST', null, function(xhr) {
						console.log(xhr.responseText);
						const result = JSON.parse(xhr.responseText),
						     li = document.createElement('li'),
						     span = document.createElement('span'),
						     bq = document.createElement('blockquote');

						if (result.status === 'OK') {
							
							span.textContent = 'You';
							span.setAttribute('class', 'username');
							bq.textContent = commentBox.value;

							li.appendChild(span);
							li.appendChild(bq);
							
							if (comment_list.hasChildNodes())
								comment_list.insertBefore(li, comment_list.childNodes[0]);
							else
								comment_list.appendChild(li);
						} else {
							console.log("You're comment could not be processed.");
						}
					}, function(xhr) {
						console.log(xhr.responseText);
					});
				});*/
			});
		</script>
	</body>
</html>
