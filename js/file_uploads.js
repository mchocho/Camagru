document.addEventListener("DOMContentLoaded", function() {
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

	function blobToFile(blob, filename){
		const file = new File([blob], filename, {type: 'image/jpeg'});
		return file;
	}

	function FileUpload(file/*, file2*/) {
		if ('File' in window && file instanceof File && isImageFile(file)) {
			console.log("Hello file upload");
			const xhr = new XMLHttpRequest(),
				  formData = new FormData(),
				  url = '../includes/upload_file_json.php';
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

			xhr.open('POST', '../includes/upload_file_json.php');
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
			img.setAttribute('src', canvas.toDataURL('image/jpeg'));
			if (gallery.hasChildNodes())
				gallery.insertBefore(img, gallery.childNodes[0]);
			else gallery.appendChild(img);

			canvas.toBlob(function(blob) {
				// file = new File([blob], img.src, { type: "image/jpeg" });
				FileUpload(blob);
			})
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
}