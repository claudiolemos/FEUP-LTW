<?php
  include_once(__DIR__.'/../database/posts.php');
  include_once(__DIR__.'/../database/comments.php');
  include_once(__DIR__.'/../database/users.php');

  $posts = getPostOfUser($_GET['id']);
  $karma = getUserKarma($_GET['id']);
  $cakeday = gmdate("Y-m-d", getUserCakeDay($_GET['id']));
  $avatar = getAvatar($_GET['id']);
?>

<?php if(userExists($_GET['id'])) {?>
<form id="user-profile-sidebar">
  <div id="avatar">
    <img style="border-radius:50%;" src="<?=$avatar?>">
  </div>
  <p class="username"><?php echo($_GET['id'])?></p>
  <p class="karma">Karma: <?php echo($karma)?> points</p>
  <p class="cake-day">Cake day: <?php echo($cakeday)?> </p>
</form>
<div id="user-history">
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
          <p class="title"><a href="<?='/post.php/?id='.$post['id']?>"><?=$post['title']?></a></p>
        </header>
        <footer>
          <span class="date"><?=gmdate("Y-m-d", $post['date'])?></span>
          <span class="username"><a href="/profile.php/?id=<?=$post['username']?>">@<?=$post['username']?></a></span>
          <span class="channel"><a href="/channel.php/?id=<?=$post['channel']?>">#<?=$post['channel']?></a></span>
          <span class="comments"><?=getNoComments($post['id'])?></span>
        </footer>
      </article>
      <?php } ?>
  </section>
</div>
<?php } else {?>
  <h1>User doesn't exist!</h1>
<?php } ?>
