<?php
require_once ('includes/upload.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      HTMLHeadTemplate("Image uploads | Mojo");
    ?>
    <link rel="stylesheet" href="css/uploads.css" media="all" />
  </head>
  
  <body>
    <?php
      include_once("includes/header.php");
    ?>

    <div class="wrapper main settings">	
      <?php
        include_once("views/upload.php");
      ?>
    </div>

    <!-- Display the app footer -->
    <?php
      include_once("views/footer.php");
    ?>


		<!-- <script src="js/file_uploads.js" type="text/javascript"></script> -->
<script type="text/javascript">
	const canvas         = document.getElementsByTagName("canvas")[0];
	const fileInput      = document.getElementById("file");
	const video          = document.getElementById("video");
	const img            = document.getElementById("image");
	const trigger        = document.getElementById("trigger");
	const save_btn       = document.getElementById("save"),
	const stream         = document.getElementById("stream_container");

	let streamActive     = false;

	save_btn.setAttribute("disabled", "true");

	function hasGetUserMedia()
  {
  		return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
	}

	function isImageFile(file)
  {
	    return file && file["type"].split("/")[0] === "image";
	}

	function FileUpload(file, url) {
		
    if ("Blob" in window && file instanceof Blob && isImageFile(file))
    {
      const xhr      = new XMLHttpRequest();
      const formData = new FormData();
      const url      = "includes/upload_file_json.php";
      const gallery  = document.getElementById("gallery");

			fileInput.setAttribute("disabled", "true");
			trigger.setAttribute("disabled", "true");

			formData.append("file", file);
			formData.append("submit", "OK");

			xhr.addEventListener("loadend", function(e)
      {
			    const obj  = JSON.parse(xhr.responseText);
          const html = "<a href=includes/remove_post.php?image=" + obj.image + "><button type="submit" value="" + "" >Delete</button></a></div><br />";

			    for (let i = 0, n = gallery.children.length; i < n; i++)
          {
			    	const el = gallery.children[i];
			    	let child;

			    	if (el.hasChildNodes())
            {
			    		child = el.childNodes[0];

			    		if (child.tagName == "IMG")
              {
			    			el.innerHTML += html;
			    			break;
			    		}
			    	}
			    }
				fileInput.removeAttribute("disabled");
				trigger.removeAttribute("disabled");
			});
			xhr.open("POST", "includes/upload_file_json.php");
			xhr.send(formData);
		}
	}

	//Disable save button if file input is empty
	fileInput.addEventListener("change", function() {
		if (fileInput.files.length == 0) {
			save_btn.setAttribute("disabled", "true");
		} else {
			save_btn.removeAttribute("disabled");
		}
		return;
	});

	stream.addEventListener("click", function activateStream() {
		if (hasGetUserMedia()) {
			document.getElementById("hint").className += " hide";

			navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
				video.classList.remove("hide");
				video.srcObject = stream;
				streamActive = true;

				this.removeEventListener("click", arguments.callee);
			});
		} else {
  			alert("getUserMedia() is not supported by your browser");
		}
	});

	function addSup(el) {
	    var imageSrc = el.src;
	    var sup = document.getElementById("supImage");
	    sup.setAttribute("src", imageSrc);
	    trigger.disabled = false;
	}

	function addSup1(el1) {
	    var imageSrc = el1.src;
	    var sup1 = document.getElementById("supImage1");
	    sup1.setAttribute("src", imageSrc);
	    trigger.disabled = false;
	}


	trigger.addEventListener("click", function() {
		if (streamActive === true) {
			const img = document.createElement("img"),
				  container = document.createElement("div"),
				  gallery = document.getElementById("gallery");
				  sup = document.getElementById("supImage");
				  sup1 = document.getElementById("supImage1");
			// let file;

			canvas.width = video.videoWidth;
			canvas.height = video.videoHeight;
			canvas.getContext("2d").drawImage(video, 0, 0,640,480);
			canvas.getContext("2d").drawImage(sup, 0, 0, 240, 180);
			canvas.getContext("2d").drawImage(sup1, 0, 0, 400, 480);

			const url = canvas.toDataURL("image/jpeg");
			img.setAttribute("src", url);
			img.setAttribute("class", "item");
			container.setAttribute("class", "img");
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
