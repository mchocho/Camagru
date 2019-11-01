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
				width: 30%;
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
					<label>
						Upload File<input type="file" accept="image/*" class="file" name="file" id="file" />
					</label>
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
	canvas = document.getElementsByTagName('canvas')[0];

	let streamActive = false;

	function hasGetUserMedia() {
  		return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
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

	function FileUpload(file) {
	  const reader = new FileReader();
	  //this.ctrl = createThrobber(img);
	  const xhr = new XMLHttpRequest();
	  this.xhr = xhr;

	  const self = this;
	  /*this.xhr.upload.addEventListener("progress", function(e) {
	        if (e.lengthComputable) {
	          const percentage = Math.round((e.loaded * 100) / e.total);
	          //self.ctrl.update(percentage);
	        }
	      }, false);*/

	  xhr.upload.addEventListener("load", function(e){
	          //self.ctrl.update(100);
	          //const canvas = self.ctrl.ctx.canvas;
	          //canvas.parentNode.removeChild(canvas);
	      }, false);
	  xhr.open("POST", "http://includes/upload_file.php");
	  xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
	  xhr.setRequestHeader("Content-type", "multipart/form-data");
	  reader.onload = function(evt) {
	    xhr.send(evt.target.result);
	  };
	  reader.readAsBinaryString(file);
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

			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(video, 0, 0);
  			// Other browsers will fall back to image/png
			img.setAttribute('src', canvas.toDataURL('image/webp'));
			if (gallery.hasChildNodes())
				gallery.insertBefore(img, gallery.childNodes[0]);
			else gallery.appendChild(img);

			const file = new File(canvas.toBlob(), img.src);
			FileUpload(file);
		}
	});
		</script>
	</body>
</html>
