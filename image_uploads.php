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
				/*width: 100px;
				height: 100px;
				background: blue;*/
			}
			button.upload {
			/*	width: 25%;
				border: none;
				background: #000;
				color: white;
			*/}

			input {
				//visibility: hidden;
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
			}

			.camera {
				width: 128px;
				height: 128px;
				background: url('images/camera.png');
				margin: auto;
			}

			.file {
				display: none;
				visibility: hidden;
			}
		</style>
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<div class="stream container">
			<span id="hint">Click to open camera <div class="camera"></div></span>
			<video id="video" autoplay></video>
			<img id="image" src="" />
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

	video.addEventListener('click', function() {
		if (hasGetUserMedia()) {
			document.getElementById('hint').className += ' hide';

			
			navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
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
			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(video, 0, 0);
  			// Other browsers will fall back to image/png
			img.src = canvas.toDataURL('image/webp');
		}
	});
		</script>
	</body>
</html>
