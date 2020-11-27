<h2>A verification link has been sent to your email account</h2>
			
<img class="icon" src="images/icons/envelope.png" alt="envelope image" />
	
<div class="content">
  <?php
    if (isset($_GET["password_reset"]))
    {
      echo "<p>Proceed to your mailbox and follow the steps provided to reset your password.</p>";
    }
    else
    {
      echo "<p>Thanks for signing up. In order to start using Mojo, you need to confirm your email address.</p>";
      echo "<p>Please click on the link that has just been sent to your email account to continue</p>";
    }
  ?>
</div>