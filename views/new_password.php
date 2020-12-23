<div class="edit password">
  <p>Reset password <div class="icon lock"></div></p>
  
  <input type="button" id="edit_password" value="Change my password" class="btn" />
  
  <form action="includes/settings.php?option=password" method="POST" id="password_input" class="input hide">
    
    <label>
      <span>Current password</span>
      <input type="password" name="password" class="text" />
    </label>
    
    <label>
      <span>New password</span>
      <input type="password" name="newpassword" class="text" />
    </label>
    
    <label>
      <span>Confirm password</span>
      <input type="password" name="confirm" class="text" />
    </label>
    
    <input type="submit" name="submit" value="Reset My Password" class="btn" />
  </form>
</div>