<?php
  include_once(__DIR__.'/../database/posts.php');

  $posts = getPosts('new');
?>

<section id="posts">
  <?php foreach($posts as $post) { ?>
    <article class="link">
      <div class="voting">
        <button class="upvote"></button>
        <span class="votes"><?=$post['votes']?></span>
        <button class="downvote"></button>
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
