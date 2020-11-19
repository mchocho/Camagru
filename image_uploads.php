<?php
session_start();

require_once ('includes/ft_util.php');
require_once('includes/sql_connect.php');

if (!isset($_SESSION['username']) && !isset($_SESSION['id']))
	ft_redirectuser('signin.php');

scream();
?>

<!DOCTYPE html>
<html>
	<head>
    <?php
      HTMLHead("Image uploads | Mojo");
    ?>
    <link rel="stylesheet" href="css/uploads.css" media="all" />
	</head>
	
	<body>
		<?php
      require_once('includes/header.php');
      ?>


		<div class="wrapper main settings">	
			<div id="stream_container" class="stream container">
				<span id="hint" class="">Click to open camera <div class="camera"></div></span>
				<video id="video" class="hide" autoplay></video>
				<div class="prview_container">
					<div id="preview">
						<img src="images/stickers/empty.png" id="supImage" width="160px" height="120px" />
					</div>
					<div id="preview1">
						<img src="images/stickers/empty.png" id="supImage1" width="260px" height="220px" />
					</div>
				</div>
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
			<div class="clip-art_container" align="center">
				<div id="sticker" width= 1px>
                       <img class="thumbnail" src="images/stickers/empty.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/mojo.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/mojo_1.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/mojo_2.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/hey.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/lowkey_dog.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/sexy_dog.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/sad_dog.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/cool_dog.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/dog_overlay.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/dinosaur.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/thinking.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/donald_trump.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/donald_trump_1.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/food.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/money.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/aliengrid.png" onclick="addSup(this)"/>
                       <img class="thumbnail" src="images/stickers/chestburster.png" onclick="addSup(this)"/>
				</div>
			</div>
			<div id="gallery" class="image_gallery" align="center">
				<?php
					try {
						$q      = "SELECT * FROM images WHERE user_id = ?";
						$result = $dbc->prepare($q);
						$result->execute([$_SESSION['id']]);
						$result = $result->fetchAll(PDO::FETCH_ASSOC);
						$result = array_reverse($result);


						foreach($result as $image => $value) {
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
	save_btn = document.getElementById('save'),
	stream = document.getElementById('stream_container');

	let streamActive = false;

	save_btn.setAttribute('disabled', 'true');

	function hasGetUserMedia() {
  		return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
	}

	function isImageFile(file) {
	    return file && file['type'].split('/')[0] === 'image';
	}

	function FileUpload(file, url) {
		if ('Blob' in window && file instanceof Blob && isImageFile(file)) {
			const xhr 		= new XMLHttpRequest(),
				  formData  = new FormData(),
				  url 		= 'includes/upload_file_json.php',
				  gallery 	= document.getElementById('gallery');

			file_uploader.setAttribute('disabled', 'true');
			trigger.setAttribute('disabled', 'true');

			formData.append('file', file);
			formData.append("submit", "OK");

			xhr.addEventListener('loadend', function(e){
			    const obj = JSON.parse(xhr.responseText),
			    	  html = '<a href=includes/remove_post.php?image=' + obj.image + '><button type="submit" value="' + '" >Delete</button></a></div><br />';

			    for (let i = 0, n = gallery.children.length; i < n; i++) {
			    	const el = gallery.children[i];
			    	let child;

			    	if (el.hasChildNodes()) {
			    		child = el.childNodes[0];

			    		if (child.tagName == 'IMG') {
			    			el.innerHTML += html;
			    			break;
			    		}
			    	}
			    }
				file_uploader.removeAttribute('disabled');
				trigger.removeAttribute('disabled');
			});
			xhr.open('POST', 'includes/upload_file_json.php');
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

	stream.addEventListener('click', function activateStream() {
		if (hasGetUserMedia()) {
			document.getElementById('hint').className += ' hide';

			navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
				video.classList.remove('hide');
				video.srcObject = stream;
				streamActive = true;

				this.removeEventListener('click', arguments.callee);
			});
		} else {
  			alert('getUserMedia() is not supported by your browser');
		}
	});

	function addSup(el) {
	    var imageSrc = el.src;
	    var sup = document.getElementById('supImage');
	    sup.setAttribute('src', imageSrc);
	    trigger.disabled = false;
	}

	function addSup1(el1) {
	    var imageSrc = el1.src;
	    var sup1 = document.getElementById('supImage1');
	    sup1.setAttribute('src', imageSrc);
	    trigger.disabled = false;
	}


	trigger.addEventListener('click', function() {
		if (streamActive === true) {
			const img = document.createElement('img'),
				  container = document.createElement('div'),
				  gallery = document.getElementById('gallery');
				  sup = document.getElementById('supImage');
				  sup1 = document.getElementById('supImage1');
			// let file;

			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext('2d').drawImage(video, 0, 0,640,480);
			canvas.getContext('2d').drawImage(sup, 0, 0, 240, 180);
			canvas.getContext('2d').drawImage(sup1, 0, 0, 400, 480);

			const url = canvas.toDataURL('image/jpeg');
			img.setAttribute('src', url);
			img.setAttribute('class', 'item');
			container.setAttribute('class', 'img');
			container.appendChild(img);
			if (gallery.hasChildNodes())
				gallery.insertBefore(container, gallery.childNodes[0]);
			else gallery.appendChild(container);

			canvas.toBlob(function(blob) {
				FileUpload(blob, url);
			})
		}
	});

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
