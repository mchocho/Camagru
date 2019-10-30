<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Awesome Title</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="manifest" href="manifest.webmanifest">
		<!-- Use inline css -->
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
				background: unset;
				border: unset;
				margin-top: -2%;
				position: relative;
				right: 11%;
				cursor: pointer;
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
		<link rel="stylesheet" href="css/style.css" media="all" />
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
		</header>
		<div class="wrapper main settings" align="center">
			<div class="image_container">
				<img src="images/uploads/underwater.jpg" />
			</div>
			<div class="social_container">
				<button id="like" name="like">
					<img src="images/icons/like.png" alt="like icon" />
				</button>
				<button id="share" name="share">
					<img src="images/icons/share.png" alt="share icon" />
				</button>
			</div>
			<div class="comments_container">
				<hr />
				<span class="heading">Comments</span>
				<span class="count">4</span>
				<hr />
				<ol class="comments">
					<li>
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
					</li>
				</ol>
			</div>
		</div>
		<footer>
			<div>Icons made by <a href="https://www.flaticon.com/authors/smashicons" title="Smashicons">Smashicons</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
		</footer>
	</body>
</html>
