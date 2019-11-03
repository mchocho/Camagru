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
			<div class="user_profile_container settings" align="right">
				<img src="images/mojo.jpg" class="profile_pic" />
				<span class="username">Thano$$</span>
				<a href="includes/logout.php" class="logout">Log out</a>
			</div>
		</header>
		<div class="wrapper main settings">
			<div id="stream_container" class="stream container">
				<span id="hint">Click to open camera <div class="camera"></div></span>
				<video id="video" class="hide" autoplay></video>
				<canvas></canvas>
			</div>
			<div class="button_container">
				<button class="trigger" id="trigger">Take Picture</button>
				<button class="upload" id="upload" aria-label-for="file">
					<form action="upload_file.php" method="post" enctype="multipart/form-data">
						<label>
							Upload File<input type="file" accept="image/*" class="file" name="file" id="file" />
						</label>
					</form>
				</button>
			</div>
			<div class="clip-art_container">
				<span>A bunch of selectable images go here!</span>
			</div>
			<div id="gallery" class="image_gallery">
				<div class="img">
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
				</div>
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

	function isFileImage(file) {
	    return file && file['type'].split('/')[0] === 'image';
	}

/*function streamCamera() {
	if (hasGetUserMedia()) {
		const video = document.querySelector('video');

		navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
			video.srcObject = stream
		});
	} else {
		//You can do better
  		alert('getUserMedia() is not supported by your browser');
	}
}*/

	function FileUpload(file1, file2) {
		if ('File' in window && file instanceof File && isFileImage(file)) {
			const xhr = new XMLHttpRequest(),
				  formData = new FormData();
			file_uploader.setAttribute('disable', 'true');
			trigger.setAttribute('disable', 'true');

			formData.append("file_1", file1);
			formData.append("file_2", file2);
			xhr.addEventListener('loadend', function(e){
				file_uploader.removeAttribute('disable');
				trigger.removeAttribute('disable');
			});
			
			xhr.open('POST', location.hostname + '/includes/upload_file.php');
			// xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
			xhr.setRequestHeader('Content-Type', multipart/form-data);
			xhr.send(form);
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
  			// Other browsers will fall back to image/png
			img.setAttribute('src', canvas.toDataURL('image/webp'));
			if (gallery.hasChildNodes())
				gallery.insertBefore(img, gallery.childNodes[0]);
			else gallery.appendChild(img);

			// file = new File(canvas.toBlob(), img.src);
			// FileUpload(file);
		}
	});

	file_uploader.addEventListener('change', function(e) {
		if (isFileImage(file_uploader.[])) {

		}
	});


		</script>
	</body>
</html>
