<?php
  include_once(__DIR__.'/../../database/posts.php');
  include_once(__DIR__.'/../../database/users.php');
  $curr_offset = 0;
  $current_channel = $_GET['id'];
  $posts = getPosts("new", $current_channel, $curr_offset);
  $curr_offset = $curr_offset + 5;

?>


  <?php if(sizeof($posts) > 0) { ?>
<div id="sort">
  <ul>
    <li name="new"><a>New</a></li>
    <li name="top"><a>Top</a></li>
    <li name="controversial"><a>Controversial</a></li>
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
    <input type="hidden" id="curr_channel" value="<?= $current_channel ?>">
    <input type="hidden" id="curr_sort" value="new">
    <input type="hidden" id="curr_offset" value="<?= $curr_offset ?>">
    <input type="button" class="load-more-posts-btn" id="load-more-posts" value="Load More Posts">
</section>
<?php } else { ?>
<div id="channel-empty-block">
  <img src="/images/empty.png">
  <p class="empty-message">It seems like nobody has posted here yet.</p>
</div>
<?php } ?>
