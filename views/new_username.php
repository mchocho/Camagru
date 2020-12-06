<div class="edit username">
  <?php echo USERNAME; ?>
  
  <input type="button" id="edit_username" value="Change Username" class="btn" />
  
  <form action="settings.php?option=username" method="POST" id="username_input" class="input hide">
    <label>
      <span>New username</span>
      <input type="text" name="username" class="text" />
    </label>
    
    <label>
      <span>Current password</span>
      <input type="password" name="password" class="text" />
    </label>

    <input type="submit" name="submit" value="Save" class="btn" />
  </form>
</div>