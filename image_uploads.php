<?php
session_start();
require_once ('includes/ft_util.php');
scream();
require_once('includes/sql_connect.php');
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
	ft_redirectuser('login.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Awesome Title</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
		<style>
			.hide {
				display: none;
				visibility: hidden;
			}

			video {
				width: 100%;
				height: 100%;
				display: inline-block;
			}

			button.upload {
			/*	width: 25%;
				border: none;
				background: #000;
				color: white;
			*/}

			input {
				display: block;
			}

			canvas {
				display: none;
				visibility: hidden;
			}

			.stream.container {
				width: 600px;
				height: 600px;
				border: 1px solid #000;
				display: inline-block;
				margin-left: 6%;
			}

			.camera {
				width: 128px;
				height: 128px;
				background: url('images/icons/camera.png');
				margin: auto;
			}

			.file {
				display: none;
				visibility: hidden;
			}

			.image_gallery {
				width: 100%;
				margin: auto;
				/*height: 450px;*/
				/*overflow-y: scroll;*/
			}

			.image_gallery .img {
				width: 400px;
				height: 400px;
				display: inline-block;
				/*display: inline;*/
				/*background: yellow;*/
			}

			.image_gallery .img img {
				width: 100%;
				/*height: 100%;*/
				/*display: inline-block;*/
				/*display: inline;*/
			}

			.image_gallery button {
				/*background: unset;*/
				/*width: 10%;*/
				width: 22%;
				/*padding: unset;*/
				/*float: right;*/
				margin: auto;
				position: relative;
				right: 38%;
				margin-top: -24%;
				border: 1px solid #eee;
			}

			.button_container {
				width: 30%;
				display: inline-block;
				margin-left: 5%;
				/*position: relative;*/
				/*top: 30px;*/
			}

			.button_container .upload {
				position: relative;
				top: 9px;
			}

			.image_gallery a {
				text-decoration: none;
			}

			.img .delete {
				/*position: absolute;*/
				/*float: left;*/
			}

			form button .upload {
				/*margin-top: 30px;*/
				/*display: inline-block;*/
			}

			/*.img .delete img {
				width: 25%;
				height: 25%;
				text-align: left;
			}*/

		</style>
	    <!-- Or link external file -->
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
<?php
require ('includes/profile_header.php');
?></header>
		<div class="wrapper main settings">
			<div id="stream_container" class="stream container">
				<span id="hint">Click to open camera <div class="camera"></div></span>
				<video id="video" class="hide" autoplay></video>
				<canvas></canvas>
			</div>
			<div class="button_container">
				<button class="trigger" id="trigger">Take Picture</button>
				<form action="includes/upload_file.php" method="post" enctype="multipart/form-data" >
					<button type="button" class="upload" id="upload" aria-label-for="file">
						<label>
							Upload File<input type="file" accept="image/*" class="file" name="file" id="file" />
						</label>
					</button>
					<button type="submit" id="save" class="btn save" name="submit" value="save">Save</button>
				</form>
			</div>
			<div class="clip-art_container">
				<span>A bunch of selectable images go here!</span>
			</div>
			<div id="gallery" class="image_gallery" align="center">
				<?php
					try {
						$q      = "SELECT * FROM images WHERE user_id = ?";
						$result = $dbc->prepare($q);
						$result->execute([$_SESSION['id']]);
						$result = $result->fetchAll(PDO::FETCH_ASSOC);
						$result = array_reverse($result);


						// print_r($result);
						foreach($result as $image => $value) {
							//ft_echo($value['name']);
							$content  = '<div class="img"><img class="item" src="images/uploads/' . $value['name'] . '" />';
							$content .= '<a href=includes/remove_post.php?image=' . $value['id'] . '>';
							$content .= '<button type="submit" value="' . $value['id'] . '" >Delete</button></a>';
							$content .= '</div>';
							echo $content;
						}
					} catch (PDOException $err) {
						ft_echo("Something went wrong");
					}

				?>
			</div>
		</div>
		<footer>
			<div>Icons made by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
		</footer>
		<!-- <script src="js/file_uploads.js" type="text/javascript"></script> -->
<script type="text/javascript">
	const video = document.getElementById('video'),
	img = document.getElementById('image'),
	trigger = document.getElementById('trigger'),
	canvas = document.getElementsByTagName('canvas')[0],
	file_uploader = document.getElementById('file'),
	save_btn = document.getElementById('save');

	let streamActive = false;

	//Disable save button by default
	save_btn.setAttribute('disabled', 'true');

	function hasGetUserMedia() {
  		return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
	}

	function isImageFile(file) {
	    return file && file['type'].split('/')[0] === 'image';
	}

	function FileUpload(file, url) {//, file2) {
		if ('Blob' in window && file instanceof Blob && isImageFile(file)) {
			console.log("Hello file upload");
			const xhr = new XMLHttpRequest(),
				  formData = new FormData(),
				  url = 'includes/upload_file_json.php',
				  gallery = document.getElementById('gallery');
			file_uploader.setAttribute('disabled', 'true');
			trigger.setAttribute('disabled', 'true');

			formData.append('file', file);
			// formData.append("file_2", file2);
			formData.append("submit", "OK");

			xhr.addEventListener('loadend', function(e){
				// console.log("xhr status: " + xhr.status);
				// console.log('status => ' + xhr.statusText)
			    console.log('response => ' + xhr.responseText);
			    const obj = JSON.parse(xhr.responseText),
			    	  // image_id = url + '?image=' + obj.image,
			    	  html = '<a href=includes/remove_post.php?image=' + obj.image + '><button type="submit" value="' + '" >Delete</button></a></div><br />';
			    console.log("id of image --> " + obj.image);

			    for (let i = 0, n = gallery.children.length; i < n; i++) {
			    	const el = gallery.children[i];
			    	let child;
			    	//Find correct img tag

			    	console.log("Found element");
			    	if (el.hasChildNodes()) {
			    		child = el.childNodes[0];

			    		console.log("Found a posible image tag --> " + child.tagName);

			    		if (child.tagName == 'IMG' /*&& child.src == url*/) {
			    			// console.log('We found an img tag --> ' + child.src);
			    			el.innerHTML += html;
			    			break;
			    		}
			    	}


			    }
				file_uploader.removeAttribute('disabled');
				trigger.removeAttribute('disabled');
			});

			// console.log('Hello FileUpload()\n\n');
			console.log(url);

			xhr.open('POST', 'includes/upload_file_json.php');
			// xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
			// xhr.setRequestHeader('Content-Type', 'multipart/form-data');
			xhr.send(formData);
		}
	}

	//Disable save button if file input is empty
	file_uploader.addEventListener('change', function() {
		if (file_uploader.files.length == 0) {
			save_btn.setAttribute('disabled', 'true');
		} else {
			save_btn.removeAttribute('disabled');
		}
		return;
	});

	document.getElementById('stream_container').addEventListener('click', function activateStream() {
		if (hasGetUserMedia()) {
			document.getElementById('hint').className += ' hide';

			navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
				video.classList.remove('hide');
				video.srcObject = stream;
				streamActive = true;
			});
		} else {
			//You can do better
  			alert('getUserMedia() is not supported by your browser');
		}
	});

	function addSup(el) {
	    var imageSrc = el.src;
	    var sup = document.getElementById('supImage');
	    sup.setAttribute('src', imageSrc);
	    document.getElementById('capture').disabled = false;
	}

	function addSup1(el1) {
	    var imageSrc = el1.src;
	    var sup1 = document.getElementById('supImage1');
	    sup1.setAttribute('src', imageSrc);
	    document.getElementById('capture').disabled = false;
	}

	trigger.addEventListener('click', function() {
		if (streamActive === true) {
			const img = document.createElement('img'),
				  container = document.createElement('div'),
				  gallery = document.getElementById('gallery');
			// let file;

			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(video, 0, 0);
			const url = canvas.toDataURL('image/jpeg');
			img.setAttribute('src', url);
			img.setAttribute('class', 'item');
			container.setAttribute('class', 'img');
			container.appendChild(img);
			if (gallery.hasChildNodes())
				gallery.insertBefore(container, gallery.childNodes[0]);
			else gallery.appendChild(container);

			canvas.toBlob(function(blob) {
				// file = new File([blob], img.src, { type: "image/jpeg" });
				FileUpload(blob, url);
			})

			// FileUpload(file);
		}
	});

	/*file_uploader.addEventListener('change', function(e) {
		if (isFileImage(file_uploader[0])) {
			FileUpload(file_uploader[0]);
		}
	});*/


	/*****************************************

				Might be cool for later

	******************************************/
	/*fetch(img.src)
	.then(res => res.blob())
	.then(blob => {
	  const file = new File([blob], 'dot.png', blob)
	  console.log(file)
	}

	fetch(img.src)
	.then(res => res.blob())
	.then(blob => {
	  const file = new File([blob], 'dot.png', blob)
	  console.log(file)
	}*/




		</script>
	</body>
</html>
