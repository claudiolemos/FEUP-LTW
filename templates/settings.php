<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/comments.php');
  include_once(__DIR__.'/../database/users.php');

  $avatar = getAvatar($_SESSION['username']);
?>
<?php if(isset($_SESSION['username']) && $_GET['id'] == $_SESSION['username']) {
  $avatar = getAvatar($_SESSION['username']);?>
  <div id="settings-sidebar">
      <form action="/actions/upload.php" method="post" enctype="multipart/form-data">
        <section id="update-profile-pic">
          <article class="image">
              <img style="border-radius:50%; object-fit: cover; width:200px; height:200px;" src="<?=$avatar?>">
          </article>
        </section>
        <p class="update-picture">Update picture</p>
        <input type="file" name="image">
        <input type="submit" value="Upload">
      </form>
      <form action="/actions/upload-default.php" method="post">
        <input type="submit" value="Delete">
      </form>
  </div>
  <div id="settings-update">
    <form method="post" action="/actions/settings-password.php">
      <label for="email">Current Password</label>
      <input type="password" name="curr-pwd" placeholder="Current Password" required >
      <label for="password">New Password</label>
      <input type="password" name="new-pwd" placeholder="New Password" required  >
      <label for="password">Confirm New Password</label>
      <input type="password" name="conf-new-pwd" placeholder="Confirm New Password"  required>
      <button type="submit">Save Password</button>
    </form>
    <form method="post" action="/actions/settings-email.php"
      <label for="email">Current Email</label>
      <input type="email" name="curr-email" placeholder="Email" required>
      <label for="email">New Email</label>
      <input type="email" name="new-email" placeholder="Email" required>
      <button type="submit">Save Email</button>
    </form>
  </div>
<?php }
else{ ?>
  <div id="error-block">
    <img src="/images/404.png">
    <p style="margin-bottom:12em;"class="error-message">Uh-oh! You took a wrong turn.</p>
  </div>
<?php } ?>
