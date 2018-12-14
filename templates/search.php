<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/users.php');
?>

<div id="search-results">
  <h1>Search Results</h1>
  <section id="search-posts">
    <h2>Posts</h2>
    <?php if($searchPosts != null) { ?>
      <?php foreach($searchPosts as $post) { ?>
        <article id="<?=$post['id']?>">
          <div class="voting">
            <button class="<?=getVoteButtonClass(getUserID($_SESSION['username']), $post['id'], 1)?>"></button>
            <span class="votes"><?=$post['votes']?></span>
            <button class="<?=getVoteButtonClass(getUserID($_SESSION['username']), $post['id'], -1)?>"></button>
          </div>
          <div class="thumbnail">
            <img src="<?=getPostThumbnail($post['id'])?>">
          </div>
          <header>
            <p class="title"><a href="<?='/post.php/?id='.$post['id']?>"><?=$post['title']?></a></p>
          </header>
          <footer>
            <span class="date"><?=gmdate("Y-m-d", $post['date'])?></span>
            <span class="username"><a href="/profile.php/?id=<?=$post['username']?>"><?=$post['username']?></a></span>
            <span class="channel"><a href="/channel.php/?id=<?=$post['channel']?>"><?=$post['channel']?></a></span>
            <span class="comments"><?=getNoComments($post['id'])?></span>
          </footer>
        </article>
        <?php } ?>
      <?php } else { ?>
        <p>No posts matched your query</p>
      <?php } ?>
  </section>

  <section id="search-users">
    <h2>Users</h2>
    <?php if($searchUsers != null) { ?>
      <div class="blocks">
        <?php foreach($searchUsers as $user) { ?>
          <a href="/profile.php/?id=<?=$user['username']?>">
            <div class="user-block">
              <div class="thumbnail">
                <img src="/images/profile/default.svg">
              </div>
              <p class="user"><?=$user['username']?></p>
            </div>
          </a>
        <?php } ?>
      </div>
    <?php } else { ?>
      <p>No users matched your query</p>
    <?php } ?>
  </section>

  <section id="search-channels">
    <h2>Channels</h2>
    <?php if($searchChannels != null) { ?>
      <ul>
      <?php foreach($searchChannels as $channel) { ?>
        <li><a href="/channel.php/?id=<?=$channel['name']?>"><?=$channel['name']?></a></li>
      <?php } ?>
      </ul>
    <?php } else { ?>
      <p>No channels matched your query</p>
    <?php } ?>
  </section>
</div>
