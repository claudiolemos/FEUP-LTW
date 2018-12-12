<?php
  include_once(__DIR__.'/../../database/channels.php');
  $channels = getSubscriptions($_SESSION['username']);
?>

<div id="search">
  <form method="get" action="/search.php">
    <input type="text" name="query" placeholder="Search..." required>
    <input type="submit" value="Submit">
  </form>
</div>
<aside id="sidebar">
  <div id="subscription-list">
    <h3>My Subscriptions</h3>
    <?php if($channels != null){ ?>
      <ul>
        <?php foreach($channels as $channel) { ?>
            <li><a href="/channel.php/?id=<?=$channel['name']?>"><?=$channel['name']?></a></li>
        <?php } ?>
      </ul>
    <?php } else { ?>
      <span>You haven't subscribed to a channel</span>
    <?php } ?>
  </div>
</aside>
