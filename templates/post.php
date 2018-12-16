<!--Depois de dar merge isto deve ir para o init-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../js/post.js"></script>

<section id="single-post">

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
        <?php if($post['link'] != null) : ?>
          <p class="title"><a href="<?=$post['link']?>"><?=$post['title']?></a>
        <? else: ?>
          <p class="title"><a href="<?='/post.php/?id='.$post['id']?>"><?=$post['title']?></a>
        <? endif; ?>
        
        <?php if($post['user_id'] == $uID) : ?>
          <img id='post-edit-<?=$post['id']?>' class='post-edit' src='/images/edit.png'">
          <img id='post-delete-<?=$post['id']?>' class='post-trashcan' src='/images/garbage.png'">
        <?php endif; ?>
        </p>


        <?php if($post['content'] != null) : ?>
          <p class ="content"><?=$post['content']?></p>
        <?php endif; ?>


      </header>
      <footer>
        <span class="date"><?=gmdate("Y-m-d", $post['date'])?></span>
        <span class="username"><a href="/profile.php/?id=<?=getUserName($post['user_id'])?>"><?=getUserName($post['user_id'])?></a></span>
        <span class="channel"><a href="/channel.php/?id=<?=getChannelName($post['channel_id'])?>"><?=getChannelName($post['channel_id'])?></a></span>
        <span class="comments"><?=getNoComments($post['id'])?></span>
      </footer>
    </article>



  <div class="write-comment-div" id="write-top-level-comment-div">
    <button type="submit" class="write-comment" value="<?= $post['id'] ?>" id="""> Write Comment... </button>
  </div>



  <?php include('templates/comments/list_comments.php'); ?>

</section>
