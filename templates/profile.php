<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/comments.php');
  include_once(__DIR__.'/../database/users.php');

  $posts = getPostOfUser($_GET['id']);
  $comments = getAllUserComments($_GET['id']);
  $karma = getUserKarma($_GET['id']);
  $cakeday = gmdate("Y-m-d", getUserCakeDay($_GET['id']));
  $avatar = getAvatar($_GET['id']);
?>

<?php if(userExists($_GET['id'])) {?>
<form id="sidebar">
  <h1><?php echo($_GET['id'])?></h1>
  <h3>Karma: <?php echo($karma)?> </h3>
  <h3>Cake day: <?php echo($cakeday)?> </h3>
  <div id="avatar">
    <img src="<?=$avatar?>">
  </div>
  <?php if(isset($_SESSION['username']) && $_SESSION['username'] == $_GET['id']) { ?>
  <div class="post">
    <button class="new_post"><a href="index.php">New Post</a></button>
  </div>
<?php }?>
</form>
<section id="posts">
  <?php foreach($posts as $post) { ?>
    <article class="link">
      <div class="voting">
        <button class="upvote"></button>
        <span class="votes"><?=$post['votes']?></span>
        <button class="downvote"></button>
      </div>
      <div class="thumbnail">
        <img src="/images/text_post.png" alt="Reddito logo">
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
<section id="comments">
  <?php foreach($comments as $comment) { ?>
    <article class="link">
      <div class="voting">
        <button class="upvote"></button>
        <span class="votes"><?=$comment['votes']?></span>
        <button class="downvote"></button>
      </div>
      <div class="thumbnail">
        <img src="images/text_post.png" alt="Reddito logo">
      </div>
      <header>
        <p class="preview"><?=$_GET['id']?> commented on <?=$comment['post']?> - <?=$comment['channel']?>, posted by <a href="profile.php?id=<?=$comment['user2']?>"> <?=$comment['user2']?></a></p>
      </header>
      <footer>
        <span class="date"><?=$comment['date']?></span>
        <span class="username"><?=$comment['username']?></span>
        <span class="post"><?=$comment['post']?></span>
      </footer>
    </article>
    <?php } ?>
</section>
<?php } else {?>
  <h1>User doesn't exist!</h1>
<?php } ?>
