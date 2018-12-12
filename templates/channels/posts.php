<?php
  include_once(__DIR__.'/../../database/posts.php');
  include_once(__DIR__.'/../../database/users.php');
  $posts = getPosts("new",$_GET['id']);
?>


<div id="sort">
  <ul>
    <li name="new">New</a></li>
    <li name="top">Top</a></li>
    <li name="controversial">Controversial</a></li>
  </ul>
</div>
<section id="channel-posts">
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
</section>
