<?php
  include_once(__DIR__.'/../../database/channels.php');
  $subscribedChannels = getSubscriptions($_SESSION['username']);
?>

<div id="search">
  <form method="get" action="/search.php">
    <input type="text" name="query" placeholder="Search..." required>
    <button type="submit">
      <i class="fa fa-search"></i>
    </button>
  </form>
</div>
<aside id="sidebar">
  <?php if(isset($_SESSION['username'])){ ?>
    <div id="subscription-list">
      <span class="subscriptions-title">My Subscriptions</span>
      <?php if($subscribedChannels != null){ ?>
        <ul>
          <?php foreach($subscribedChannels as $channel) { ?>
              <li><a href="/channel.php/?id=<?=$channel['name']?>"><?=$channel['name']?></a></li>
          <?php } ?>
        </ul>
      <?php } else { ?>
        <span class="no-subscriptions">You haven't subscribed to a channel</span>
      <?php } ?>
    </div>
    <div class="create-channel">
      <button onclick="document.getElementById('create-channel-pop-up').style.display='block'" >Create Channel</button>
    </div>
    <div id="create-channel-pop-up" class="pop-up">
      <form method="post" class="pop-up-content animate" action="/../actions/create_channel.php">
        <div class="close-button">
          <span onclick="document.getElementById('create-channel-pop-up').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
          <label><a>Name</a></label>
          <input type="text" name="name" placeholder="Name" required>
          <label><a>Description</a></label>
          <input type="textarea" name="description" placeholder="Description" required>
          <button type="submit">Create channel</button>
        </div>
      </form>
    </div>
  <?php } ?>
  <div class="random-channel">
    <button onclick="location.href='/channel.php/?id=<?=getRandomChannel()?>';">Random channel</button>
  </div>
</aside>
