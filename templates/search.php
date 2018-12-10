<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/users.php');
?>

<div id="search-results">
  <section id="posts">
    <h1>Posts</h1>
    <?php foreach($posts as $post) { ?>
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
          <p class="title"><?=$post['title']?></p>
        </header>
        <footer>
          <span class="date"><?=gmdate("Y-m-d", $post['date'])?></span>
          <span class="username"><?=$post['username']?></span>
          <span class="channel"><?=$post['channel']?></span>
          <span class="comments"><?=getNoComments($post['id'])?></span>
        </footer>
      </article>
      <?php } ?>
  </section>

  <section id="comments">
    <h1>Comments</h1>
    <?php foreach($comments as $comment) { ?>
      <article>
        <div class="voting">
          <button class="upvote"></button>
          <span class="votes"><?=$comment['votes']?></span>
          <button class="downvote"></button>
        </div>
        <header>
          <p class="preview"><?=$comment['content']?></p>
        </header>
        <footer>
          <span class="date"><?=gmdate("Y-m-d", $comment['date'])?></span>
          <span class="username"><?=$comment['user1']?></span>
          <span class="post"><?=$comment['title']?></span>
          <span class="by"><?=$comment['user2']?></span>
          <span class="channel"><?=$comment['channel']?></span>
        </footer>
      </article>
      <?php } ?>
  </section>

  <section id="users">
    <h1>Users</h1>
    <?php foreach($users as $user) { ?>
      <p class="user"><?=$user['username']?></p>
      <?php } ?>
  </section>

  <section id="channels">
    <h1>Channels</h1>
    <?php foreach($channels as $channel) { ?>
      <p class="channel"><?=$channel['name']?></p>
      <?php } ?>
  </section>
</div>
