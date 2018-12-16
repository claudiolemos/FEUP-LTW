<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/comments.php');
  include_once(__DIR__.'/../database/users.php');

  $avatar = getAvatar($_SESSION['username']);
?>
<?php if(isset($_SESSION['username']) && $_GET['id'] == $_SESSION['username']) {
  $avatar = getAvatar($_SESSION['username']);?>
  <div id="sidebar">
      <form action="/actions/upload.php" method="post" enctype="multipart/form-data">
        <h1>Avatar</h1>
        <input type="file" name="image">
        <input type="submit" value="Upload">
      </form>
      <form action="actions/upload-default.php" method="post">
        <input type="submit" value="Default">
      </form>
      <section id="images">
        <article class="image">
            <img src="<?=$avatar?>" width="200" height="200">
        </article>
      </section>
  </div>
  <div id="update_settings">
    <form method="get" action="/actions/settings-password.php">
      <label for="email">Current Password</label>
      <input type="password" name="curr-pwd" placeholder="Current Password" >
      <label for="password">New Password</label>
      <input type="password" name="new-pwd" placeholder="New Password"  >
      <label for="password">Confirm New Password</label>
      <input type="password" name="conf-new-pwd" placeholder="Confirm New Password" >
      <button type="submit">Save Password</button>
    </form>
    <form method="get" action="/actions/settings-email.php"
      <label for="email">Current Email</label>
      <input type="email" name="curr-email" placeholder="Email">
      <label for="email">New Email</label>
      <input type="email" name="new-email" placeholder="Email">
      <button type="submit">Save Email</button>
    </form>
  </div>
<?php }
else{ ?>
  <h1>NOPE!</h1>
<?php } ?>
