<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/comments.php');
  include_once(__DIR__.'/../database/users.php');

?>
<form id="sidebar">
  <h1>ola</h1>
</form>
<?php if(isset($_SESSION['username']) && $_GET['id'] == $_SESSION['username']) {?>
  <div id="update_settings">
    <form method="settings" action="actions/settings.php">
      <input type="password" name="curr_pwd" id="pwd" placeholder="Password" required>
      <input type="password" name="new_pwd" id="new_pwd" placeholder="Password" required >
      <input type="password" name="conf_new_pwd" id="conf_new_pwd" placeholder="Password" required >
      <br>
      <span id='message'></span>
      <br>
      <label for="email">Current Email</label>
      <input type="email" name="curr_email" placeholder="Email" required>
      <label for="email">New Email</label>
      <input type="email" name="new_email" placeholder="Email" required>
      <div class="submit_button">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
<?php }
else{ ?>
  <h1>NOPE!</h1>
<?php } ?>
