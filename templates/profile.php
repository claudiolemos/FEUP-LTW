<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/comments.php');
  include_once(__DIR__.'/../database/users.php');

  $posts = getPostOfUser($_GET['id']);
  $comments = getAllUserComments($_GET['id']);
  $karma = getUserKarma($_GET['id']);
  $cakeday = getUserCakeDay($_GET['id']);
?>

<aside id="sidebar">
  <h1><?php echo($_GET['id'])?></h1>
  <h3>Karma: <?php echo($karma)?> </h3>
  <h3>Cake day: <?php echo($cakeday)?> </h3>
  <p>Proin lectus felis, fringilla nec magna ut, vestibulum volutpat elit. Suspendisse in quam sed tellus fringilla luctus quis non sem. Aenean varius molestie justo, nec tincidunt massa congue vel. Sed tincidunt interdum laoreet. Vivamus vel odio bibendum, tempus metus vel.</p>
</aside>
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
<section id="comments">
  <?php foreach($comments as $comment) { ?>
    <article class="link">
      <div class="voting">
        <button class="upvote"></button>
        <span class="votes"><?=$comment['votes']?></span>
        <button class="downvote"></button>
      </div>
      <img src="https://googlechrome.github.io/samples/picture-element/images/butterfly.jpg" alt="Reddito logo">
      <header>
        <p class="preview"><?=$_GET['id']?> commented on <?=$comment['post']?> - <?=$comment['channel']?>, posted by <a href="profilepage.php?id=<?=$comment['user2']?>"> <?=$comment['user2']?></a></p>
      </header>
      <footer>
        <span class="date"><?=$comment['date']?></span>
        <span class="username"><?=$comment['username']?></span>
        <span class="post"><?=$comment['post']?></span>
      </footer>
    </article>
    <?php } ?>
</section>
