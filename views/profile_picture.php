<div class="edit pic">
  <div class="profile_container">
      <img src="images/mojo.jpg" id="pic" class="pic" />
  </div>
  
  <input type="button" id="edit_pic" value="Change Profile Pic" class="btn" />
  
  <form action="settings.php?option=profile" method="POST" enctype="multipart/form-data" id="pic_input" class="input hide">
    <button>
      <label>
        Change profile picture
        <input type="file" id="file" name="pic" class="file" />
      </label>
    </button>
    
    <input type="submit" name="submit" value="Save" class="btn" />
  </form>
</div>