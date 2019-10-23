<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Awesome Title</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
		<style>
			video {
				width: 100px;
				height: 100px;
				color: blue;
			}
			button.upload {
			/*	width: 25%;
				border: none;
				background: #000;
				color: white;
			*/}

			input.file {
				visibility: hidden;
			}

			canvas {
				display: none;
				visibility: hidden;
			}

			i.camera {
				width: 128px;
				height: 128px;
				background: url('images/camera.png');
			}
		</style>
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<div class="stream container">
			<video autoplay>
				Click to open camera <i class="camera"></i>
			</video>
			<img src="" />
			<canvas style="display:none;"></canvas>
		</div>
		<div class="button_container">
			<button class="trigger" id="trigger">Take Picture</button>
		
			<button class="upload" aria-label-for="file">
				Upload File<input type="file" accept="image/*" class="file" name="file" id="file" />
			</button>
		</div>
		<script type="text/javascript">
			function hasGetUserMedia() {
  return !!(navigator.mediaDevices &&
    navigator.mediaDevices.getUserMedia);
}

function streamCamera() {
	if (hasGetUserMedia()) {
		const video = document.querySelector('video');

		navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
			video.srcObject = stream
		});
	} else {
		//You can do better
  		alert('getUserMedia() is not supported by your browser');
	}
}
		</script>
	</body>
</html>
