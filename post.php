<?php
session_start();
require('includes/ft_util.php');
require('includes/sql_connect.php');

if (!isset($_GET['id']))
	ft_redirectuser();

try {
	$q      = "SELECT * FROM images WHERE (id = ?)";
	$result = $dbc->prepare($q);
	$result->execute([$_GET['id']]);
	$result = $result->fetch(PDO::FETCH_ASSOC);
	// ft_print_r($result);
} catch (PDOException $e) {
	ft_echo($e->getMessage());
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Awesome Title</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="manifest.webmanifest">
		<link rel="stylesheet" href="css/style.css" media="all" />
		<style>
			.wrapper {
				margin: auto;
				width: 100%;
			}

			.wrapper * {
				/*margin: auto;*/
			}

			.image_container img {
				width: 40%;
				height: 500px;
			}

			button, button:active, button:focus {
				width: 25%;
				height: 25px;
				background: unset;
				border: unset;
				margin-top: -2%;
				margin-left: -20%;
				cursor: pointer;
				display: inline-block;
				/*background: yellow;*/
			}

			button #share, button #delete {
				/*margin-left: -25%;*/
				/*position: relative;*/
				/*right: 11%;*/
			}

			#like {
				z-index: 99999;
			}

			#share {
				right: 16%;
			}

			.social_container img {
				-webkit-transform: scale(0.5);
        			-ms-transform: scale(0.5);
            			transform: scale(0.5);
			}

			.comments_container {
				margin-top: -25px;
			}

			hr {
				width: 40%;
			}

			.comments {
				width: 40%;
				list-style: none;
				text-align: left;

			}

			.username {
				display: inline-block;
				font-size: 105%;
				font-weight: bold;
				font-style: italic;
			}

			blockquote {
				display: inline-block;
			}

			.created {
				display: block;
			}
		</style>
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
				<!-- <img src="images/uploads/underwater.jpg" /> -->
				<?php
					echo '<img src="images/uploads/' . $result['name'] . '" />';
				?>
			</div>
			<div class="social_container">
				<button id="like" name="like">
					<img src="images/icons/like.png" alt="like icon" />
				</button>
				<button id="share" name="share">
					<img src="images/icons/share.png" alt="share icon" />
				</button>
				<button id="delete" name="delete">
					<img src="images/icons/delete.png" alt="delte icon" />
				</button>
			</div>
			<div class="comments_container">
				<?php 
					try {
						$q      = "SELECT * FROM comment WHERE (image_id = ?)";
						$comment = $dbc->prepare($q);
						$comment->execute([$_GET['id']]);
						$comment = $result->fetchAll()/*(PDO::FETCH_ASSOC)*/;
						$comment_count = count($comment);
					} catch (PDOException $e) {
						ft_echo($e->getMessage());
					}
				?>
				<hr />
				<span class="heading">Comments</span>
				<span class="count">
					<?php
						ft_echo("hello world"); 
						if (isset($comment_count))
							echo $comment_count;
						else echo "0";
					?>
				</span>
				<hr />
				<form method="POST" action="includes/comments.php">
					<textarea id="comment" name="comment" placeholder="Add a comment"></textarea>
					<input type="submit" name="submit" class="btn" value="Post" />
					<!-- <input type="hidden" name="image" value="This will be an image id" /> -->
				</form>
				<ol class="comments">
					<?php 
						if (isset($comment)) {	
							foreach ($comment as $key => $value) {
								try {
									$q      = "SELECT username FROM users WHERE (image_id = ?)";
									$user = $dbc->prepare($q);
									$user->execute([$value['user_id']]);
									$user = $user->fetch(PDO::FETCH_ASSOC);

									$html = '<li><span class="username">' . $user['username'] . '</span>';
									$html .= '<blockquote>' . $result['message'] . '</<blockquote></li>';

									echo $html;
								}  catch (PDOException $e) {
									ft_echo($e->getMessage());
								}
							}
						}
					?>
					<!-- <li>
						<span class="username">Adam</span>
						<blockquote>JFC this pic describes how I feel inside</blockquote>
						<span class="created">3d</span>
					</li>
					<li>
						<span class="username">Tshego</span>
						<blockquote>Wow</blockquote>
						<span class="created">3h</span>
					</li>
					<li>
						<span class="username">Guy</span>
						<blockquote>Cool</blockquote>
						<span class="created">3m</span>
					</li>
					<li>
						<span class="username">Buddy</span>
						<blockquote>Big ups to the photographer. We know that these kind of shots are what make great photographers.</blockquote>
						<span class="created">3d</span>
					</li> -->
				</ol>
			</div>
		</div>
		<footer>
			<div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
		</footer>
	</body>
</html>
