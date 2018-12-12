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
      <label for="email">Current Password</label>
      <input type="password" name="curr-pwd" placeholder="Current Password" >
      <label for="password">New Password</label>
      <input type="password" name="new-pwd" placeholder="New Password"  >
      <label for="password">Confirm New Password</label>
      <input type="password" name="conf-new-pwd" placeholder="Confirm New Password"  >
      <label for="email">Current Email</label>
      <input type="email" name="curr-email" placeholder="Email">
      <label for="email">New Email</label>
      <input type="email" name="new-email" placeholder="Email">
      <button type="submit">Save</button>
    </form>
  </div>
<?php }
else{ ?>
  <h1>NOPE!</h1>
<?php } ?>
