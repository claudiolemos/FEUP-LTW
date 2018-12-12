<!--Depois de dar merge isto deve ir para o init-->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="../../js/post.js"></script>

<section id="posts">
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
  <div class="write-comment-div" id="write-top-level-comment-div">
    <button type="submit" class="write-comment" value="<?= $post['id'] ?>" id="""> Write Comment... </button>
  </div>



  <?php include('templates/comments/list_comments.php'); ?>

</section>
