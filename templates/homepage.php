<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/users.php');
  $posts = getPosts("top");
?>


<div id="sort">
  <ul>
    <li name="new">New</a></li>
    <li name="top">Top</a></li>
    <li name="controversial">Controversial</a></li>
  </ul>
</div>
<section id="posts">
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
