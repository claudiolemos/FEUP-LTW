<?php
  include_once(__DIR__.'/../database/posts.php');
  $posts = getPosts('new');
?>

<section id="posts">
  <?php foreach($posts as $post) { ?>
    <article class="link">
      <div class="voting">
          <button class="<?=getPostVoteButtonClass($_SESSION['username'], $post['id'], 1)?>" value="<?=$post['votes'] + 1?>"></button>
        <span class="votes" value="<?=$post['votes']?>"><?=$post['votes']?></span>
        <button class="<?=getPostVoteButtonClass($_SESSION['username'], $post['id'], -1)?>" value="<?=$post['votes'] - 1?>"></button>
      </div>
      <div class="thumbnail">
        <img src="images/text_post.png" alt="Reddito logo">
      </div>
      <header>
        <p class="title"><?=$post['title']?></p>
      </header>
      <footer>
        <span class="date"><?=$post['date']?></span>
        <span class="username"><?=$post['username']?></span>
        <span class="channel"><?=$post['channel']?></span>
        <span class="comments">2</span>
      </footer>
    </article>
    <?php } ?>
</section>
