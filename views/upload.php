<?php
  $images = array(
    "empty",        "mojo",           "mojo_1",     "mojo_2", 
    "hey",          "lowkey_dog",     "sexy_dog",   "sad_dog",
    "cool_dog",     "dog_overlay",    "dinosaur",   "thinking",
    "donald_trump", "donald_trump_1", "food",       "money",
    "aliengrid",    "chestburster",   "empty"
  );
?>

<!-- Create camera view -->
<div id="stream_container" class="stream container">
  
  <span id="hint">Click to open camera <div class="camera"></div></span>
  
  <!-- Container for camera -->
  <video id="video" class="hide" autoplay></video>
  
  <div class="prview_container">
    <!-- First sticker -->
    <div id="preview">
      <img src="images/stickers/empty.png" id="supImage" width="160px" height="120px" />
    </div>
    
    <!-- 2nd sticker -->
    <div id="preview1">
      <img src="images/stickers/empty.png" id="supImage1" width="260px" height="220px" />
    </div>
  
  </div>
  
  <canvas></canvas>
</div>


<div class="button_container">
  <ul class="errors">
    <?php 
      if (isset($_GET["error_1"]))
        echo "<li>Something went wrong!</li>";

      if (isset($_GET["error_2"]))
        echo "<li>The file you provided is too large.</li>";

      if (isset($_GET["error_3"]))
        echo "<li>Something went wrong. Please try again.</li>";

      if (isset($_GET["error_4"]))
        echo "<li>Please enter a password of 5 characters. Use uppercase && lowercase.</li>";

      if (isset($_GET["error_5"]))
        echo "<li>You can't upload files of this type.</li>";
    ?>
  </ul>

	<!-- Camera trigger -->
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
    <?php
      foreach ($images as $value)
        echo '<img class="thumbnail" src="images/stickers/' $value '.png" onclick="addSup(this)"/>';
	  ?>
  </div>
</div> 