document.addEventListener("DOMContentLoaded", script);

function script()
{
  const fileInput      = document.getElementById("file");
  const stream         = document.getElementById("stream_container");
  const trigger        = document.getElementById("trigger");
  const sticker1       = document.getElementById("preview");
  const sticker2       = document.getElementById("preview1");
  const icons          = document.querySelectorAll(".thumbnail");

  let   cameraEnabled  = false;

  function onFileInputChange(e)
  {
    const target       = e.currentTarget;
    const saveBtn      = document.getElementById("save");

    if (target.files.length == 0)
      saveBtn.setAttribute("disabled", "true");
    else
      saveBtn.removeAttribute("disabled");
  }

  //Disable save button if file input is empty
  fileInput.addEventListener("change", onFileInputChange);

  function hasGetUserMedia()
  {
    return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
  }

  function enableCamera(e)
  {
    if (cameraEnabled)
     return;

    const notificationEl = document.getElementById("hint");
    const video          = document.getElementById("video");
    const streamOptions  = {video: true};

    if (!hasGetUserMedia())
    {
      notificationEl.textContent = "getUserMedia() is not supported by your browser.";
      return;
    }

    notificationEl.classList.add("hide");
    notificationEl.textContent = "";

    navigator.mediaDevices.getUserMedia(streamOptions)
    .then(stream =>
    {
      video.classList.remove("hide");
      video.srcObject = stream;
      cameraEnabled   = true;

      stream.removeEventListener("click", this);
    })
    .catch(e =>
    {
      cameraEnabled = false;
      notificationEl.textContent = "Please try again.";
    });
  }

  //Enable camera on request
  stream.addEventListener("click", enableCamera);

  function changeIcon(e)
  {
    const target = e.currentTarget;
    const src    = target.src;
    const id     = (target.id === "preview") ? "sticker1" : "sticker2";
    const img    = document.getElementById(id);

    img.setAttribute("src", src);
    trigger.disabled = false;
  }

  sticker1.addEventListener("click", changeIcon);
  sticker2.addEventListener("click", changeIcon);

  for (let i = 0, len = icons.length; i < len; i++)
  {
    console.log(icons[i].src);

    icons[i].addEventListener("click", changeIcon)
  }

  function focusImage(e)
  {
    const target = e.currentTarget;
    traget  ((target.id === sticker1) ? sticke1 : sticker2);
    // const src    = target.src;


  }

  // [...icons].forEach(icon => icon.addEventListener("click", changeIcon));

  /*function addSup(el) {
      var imageSrc = el.src;
      var sup = document.getElementById("sticker1");
      sup.setAttribute("src", imageSrc);
      trigger.disabled = false;
  }*/

  /*function addSup1(el1) {
      var imageSrc = el1.src;
      var sup1 = document.getElementById("supImage1");
      sup1.setAttribute("src", imageSrc);
      trigger.disabled = false;
  }*/

  function isImageFile(file)
  {
    return file && file["type"].split("/")[0] === "image";
  }

  function updateNewFile(res)
  {
    const obj      = JSON.parse(res.responseText);
    const gallery  = document.getElementById("gallery");
    const len      = gallery.children.length;
    const html     = `<a href="includes/remove_post.php?image=${obj.image}">
                        <button type="submit">Delete</button>
                      </a>
                      <br />`;

    for (let i = 0; i < len; i++)
    {
      const el = gallery.children[i];

      if (!el.hasChildNodes())
        continue;

      const child = el.childNodes[0];

      if (child.tagName == "IMG")
      {
        el.innerHTML += html;
        break;
      }
    }
  
    fileInput.removeAttribute("disabled");
    trigger.removeAttribute("disabled");
  }

  function uploadFailed()
  {

  }

  function uploadFile(file)
  {  
    const URL      = "includes/camera.php";
    
    if (!("Blob" in window && file instanceof Blob && isImageFile(file)))
      return;

    const form = new FormData();

    fileInput.setAttribute("disabled", "true");
    trigger.setAttribute("disabled", "true");

    form.append("file", file);
    form.append("submit", "OK");

    xhr(URL, form)
    .then(updateNewFile)
    .catch(uploadFailed);
  }

  function takePicture(e)
  {
    if (!cameraEnabled)
      return;

      const canvas    = document.getElementsByTagName("canvas")[0];
      const video     = document.getElementById("video");
      const gallery   = document.getElementById("gallery");
      const sup       = document.getElementById("sticker1");
      const sup1      = document.getElementById("sticker2");

      const newImg    = document.createElement("img");
      const container = document.createElement("div");

      canvas.width    = video.videoWidth;
      canvas.height   = video.videoHeight;

      canvas.getContext("2d").drawImage(video, 0, 0, 640, 480);
      canvas.getContext("2d").drawImage(sup,   0, 0, 240, 180);
      canvas.getContext("2d").drawImage(sup1,  0, 0, 400, 480);

      const url       = canvas.toDataURL("image/jpeg");

      newImg.setAttribute("src", url);
      newImg.setAttribute("class", "item");

      container.setAttribute("class", "img");
      container.appendChild(newImg);
      
      if (gallery.hasChildNodes())
        gallery.insertBefore(container, gallery.childNodes[0]);
      else
        gallery.appendChild(container);

      canvas.toBlob(function(blob)
      {
        uploadFile(blob);
      });
  }

  trigger.addEventListener("click", takePicture);
}