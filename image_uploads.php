<!DOCTYPE html>
<html>
	<head>
	    <meta charset="utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <title>Awesome Title</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- Use inline css -->
		<style>
			button.upload {
				width: 25%;
				border: none;
				background: #000;
				color: white;
			}

			input.file {
				visibility: hidden;
			}
		</style>
	    <!-- Or link external file -->
        <!-- <link rel="stylesheet" href="css/style.css" media="all" /> -->
	</head>
	<body>
		<!-- Content goes here -->
		<div class="stream container">
			<video autoplay></video>
		</div>
		<div class="upload_container">
			<button class="upload">
				<input type="file" accept="image/*" class="file"/>
			</button>
		</div>
		<script type="text/javascript">
			function hasGetUserMedia() {
  return !!(navigator.mediaDevices &&
    navigator.mediaDevices.getUserMedia);
}

if (hasGetUserMedia()) {
  // Good to go!
	alert('The nigga has getUserMedia(). Now work!');
	const constraints = {
  video: {width: {min: 1280}, height: {min: 720} }};

const video = document.querySelector('video');

navigator.mediaDevices.getUserMedia(constraints).
  then((stream) => {video.srcObject = stream});
} else {
  alert('getUserMedia() is not supported by your browser');
}
		</script>
	</body>
</html>
