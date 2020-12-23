<div class="edit email">
  <?php echo EMAIL; ?>
  
  <input type="button" id="edit_email" value="Change email" class="btn" />
  
  <form action="includes/settings.php?option=email" method="POST" id="email_input" class="input hide">
    
    <label>
      <span>New email</span>
      <input type="text" name="email" class="text" />
    </label>

    <label>
      <span>Current password</span>
      <input type="password" name="password" class="text" />
    </label>

    <input type="submit" name="submit" value="Save" class="btn" />
  </form>
</div>