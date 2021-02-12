<div class="edit notifications">
  <?php echo NOTIFICATIONS; ?>
  
  <input type="button" id="edit_notifications" value="Change notifications" class="btn" />
  
  <form action="includes/settings.php?option=notifications" method="POST" id="notifications_input" class="input">
    
    <label>
      <?php echo HTML_ICON_NOTIFICATIONS; ?>
    </label>

    <input type="submit" name="submit" value="Save" class="btn hide" />
  </form>
</div>