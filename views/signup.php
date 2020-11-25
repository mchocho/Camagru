<h2>Sign Up</h2>

<form action="includes/signup.php" method="POST">
  <ul class="errors">
    <?php 
      if (isset($_GET['error_1']))
        echo "<li>Please enter your username</li>";

      if (isset($_GET['error_2']))
        echo "<li>Please enter your email address.</li>";

      if (isset($_GET['error_3']))
        echo "<li>Please enter your password</li>";

      if (isset($_GET['error_4']))
        echo "<li>Please enter a password of 8 characters. Use uppercase && lowercase.</li>";

      if (isset($_GET['error_5']))
        echo "<li>The passwords provided don't match.</li>";

      if (isset($_GET['error_6']))
        echo "<li>Email already exists</li>";

      if (isset($_GET['error_7']))
        echo "<li>Username already exists.</li>";

      if (isset($_GET['error_8']))
        echo "<li>Something went wrong. Please try again.</li>";
    ?>
  </ul>
  
  <label>
    <span>Username</span>
    <input type="text" name="username" class="text" required="true" />
  </label>
  
  <br />
  
  <label>
    <span>Email</span>
    <input type="email" name="email" class="text" required="true" />
  </label>
  
  <br />
  
  <label>
    <span>Password</span>
    <input type="password" name="password" class="text" required="true" />
  </label>
  
  <br />
  
  <label>
    <span>Confirm Password</span>
    <input type="password" name="confirm_password" class="text" required="true" />
  </label>
  
  <br />
  
  <input type="submit" name="submit" value="Sign Up" class="btn" />
</form>