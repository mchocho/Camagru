<!-- Create camera view -->
<div id="stream_container" class="stream container">
  
  <span id="hint">Click to open camera <div class="camera"></div></span>
  
  <!-- Container for camera -->
  <video id="video" class="hide" autoplay></video>
  
  <div class="prview_container">
    <!-- First sticker -->
    <div id="preview">
      <img src="images/stickers/empty.png" id="sticker1" width="160px" height="120px" />
    </div>
    
    <!-- 2nd sticker -->
    <div id="preview1">
      <img src="images/stickers/empty.png" id="sticker2" width="260px" height="220px" />
    </div>
  
  </div>
  
  <canvas></canvas>
</div>

<div class="button_container">
  <ul class="errors">
    <?php 
      if (isset($_GET["error_1"]))
        echo "<li>Something went wrong. Please try again.</li>";

      if (isset($_GET["error_2"]))
        echo "<li>No file selected.</li>";

      if (isset($_GET["error_3"]))
        echo "<li>You can't upload files of this type.</li>";

      if (isset($_GET["error_4"]))
        echo "<li>The file you provided is too large.</li>";
    ?>
  </ul>

	<!-- Camera trigger -->
  <button class="trigger" id="trigger">Take Picture</button>
	
  <form action="includes/upload.php" method="POST" enctype="multipart/form-data" >
    
    <button type="button" class="upload" id="upload" aria-label-for="file">
      <label>
				Upload File<input type="file" accept="image/*" class="file" name="file" id="file" />
      </label>
    </button>
		
    <button type="submit" id="save" class="btn save" name="submit" value="save" disabled="disabled">Save</button>
  </form>
</div>

<div class="clip-art_container" align="center">
	<div id="sticker">
    <?php
      if (isset($stickers))
        renderstickers($stickers);
	  ?>
  </div>
</div>

<div id="gallery" class="image_gallery" align="center">
  <?php
    if (isset($images))
      renderimages($images);
  ?>
</div>