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
				width: 80%;
				overflow-y: scroll;
			}

			.image_gallery .img {
				display: inline-block;
				width: 40px;
				height: 40px;
			}

			.image_gallery button {
				background: unset;
				width: 10%;
				padding: unset;
				float: right;
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

			.img .delete {
				/*position: absolute;*/
				/*float: left;*/
			}

			form .save {
				margin-top: 30px;
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
			?> 
		</header>
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
					<br />
					<button type="submit" class="btn save" name="submit" value="save">Save</button>
				</form>
			</div>
			<div class="clip-art_container">
				<span>A bunch of selectable images go here!</span>
			</div>
			<div id="gallery" class="image_gallery">
				<!-- <div class="img">
					<img src="images/uploads/ocean.jpg" class="item" />
				</div>
				<div class="img">
					<img src="images/uploads/ocean.jpg" class="item" />
				</div>
				<div class="img">
					<img src="images/uploads/ocean.jpg" class="item" />
				</div>
				<div class="img">
					<img src="images/uploads/ocean.jpg" class="item" />
				</div> -->
			</div>
		</div>
		<footer>
			<div>Icons made by <a href="https://www.flaticon.com/authors/kiranshastry" title="Kiranshastry">Kiranshastry</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
		</footer>
<script type="text/javascript">
	const video = document.getElementById('video'),
	img = document.getElementById('image'),
	trigger = document.getElementById('trigger'),
	canvas = document.getElementsByTagName('canvas')[0],
	file_uploader = document.getElementById('file');

	let streamActive = false;

	function hasGetUserMedia() {
  		return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
	}

	function isImageFile(file) {
	    return file && file['type'].split('/')[0] === 'image';
	}

	function FileUpload(file/*, file2*/) {
		if ('Blob' in window && file instanceof Blob && isImageFile(file)) {
			console.log("Hello file upload");
			const xhr = new XMLHttpRequest(),
				  formData = new FormData(),
				  url = /*location.hostname + '/camagru/*/'includes/upload_file_json.php';
			file_uploader.setAttribute('disable', 'true');
			trigger.setAttribute('disable', 'true');

			formData.append("file", file);
			// formData.append("file_2", file2);
			formData.append("submit", "OK");

			xhr.addEventListener('loadend', function(e){
				console.log("xhr status: " + xhr.status);
				console.log('status => ' + xhr.statusText)
			    console.log('response => ' + xhr.responseText);
				file_uploader.removeAttribute('disable');
				trigger.removeAttribute('disable');
			});

			console.log('Hello FileUpload()\n\n');
			console.log(url);

			xhr.open('POST', /*location.hostname + '/camagru/*/'includes/upload_file_json.php');
			// xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
			// xhr.setRequestHeader('Content-Type', 'multipart/form-data');
			xhr.send(formData);
		}
	}

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

	trigger.addEventListener('click', function() {
		if (streamActive === true) {
			const img = document.createElement('img'),
				  gallery = document.getElementById('gallery');
			let file;

			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(video, 0, 0);
			img.setAttribute('src', canvas.toDataURL('image/webp'));
			if (gallery.hasChildNodes())
				gallery.insertBefore(img, gallery.childNodes[0]);
			else gallery.appendChild(img);

			canvas.toBlob(function(blob) {
				// file = new File([blob], img.src, { type: "image/jpeg" });
				FileUpload(blob);
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
