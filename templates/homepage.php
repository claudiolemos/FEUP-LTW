<?php
  include_once('database/posts.php');

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
      <img src="https://googlechrome.github.io/samples/picture-element/images/butterfly.jpg" alt="Reddito logo">
      <header>
        <p class="title"><?=$post['title']?></p>
        <p class="preview"><?=$post['content']?></p>
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
