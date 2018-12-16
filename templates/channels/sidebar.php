<div id="search">
  <form method="get" action="/search.php">
    <input type="text" name="query" placeholder="Search..." required>
    <input type="submit" value="Submit">
  </form>
</div>
<aside id="sidebar">
  <div id="channel-id">
      <div class="name"><?=$channel['name']?></div>
      <div class="description"><?=$channel['description']?></div>
      <div class="subscribers"><?=getChannelSubscribers($channel['id'])?></div>
      <div class="creation"><?=time_elapsed($channel['creation_day'])?></div>
  </div>
  <?php if(isset($_SESSION['username'])){ ?>
    <div class="subscription">
      <button><?=isSubscribed($_SESSION['username'], $_GET['id'])? Unsubscribe : Subscribe?></button>
    </div>
    <div class="add-text-post">
      <button onclick="document.getElementById('add-text-post-pop-up').style.display='block'" >Add text post</button>
    </div>
    <div id="add-text-post-pop-up" class="pop-up">
      <form method="post" class="pop-up-content animate" action="/../actions/add_text_post.php">
        <div class="close-button">
          <span onclick="document.getElementById('add-text-post-pop-up').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
          <label><a>Title</a></label>
          <input type="text" name="title" placeholder="Title" required>
          <label><a>Content</a></label>
          <input type="textarea" name="content" placeholder="Content" required>
          <input type="hidden" name="username" value="<?=$_SESSION['username']?>">
          <input type="hidden" name="channel" value="<?=$channel['name']?>">
          <button type="submit">Submit post</button>
        </div>
      </form>
    </div>
    <div class="add-link-post">
      <button onclick="document.getElementById('add-link-post-pop-up').style.display='block'" >Add link post</button>
    </div>
    <div id="add-link-post-pop-up" class="pop-up">
      <form method="post" class="pop-up-content animate" action="/../actions/add_link_post.php">
        <div class="close-button">
          <span onclick="document.getElementById('add-link-post-pop-up').style.display='none'" class="close">&times;</span>
        </div>
        <div class="container">
          <label><a>Title</a></label>
          <input type="text" name="title" placeholder="Title" required>
          <label><a>Link</a></label>
          <input type="url" name="link" placeholder="https://example.com" required>
          <input type="hidden" name="username" value="<?=$_SESSION['username']?>">
          <input type="hidden" name="channel" value="<?=$channel['name']?>">
          <button type="submit">Submit post</button>
        </div>
      </form>
    </div>
  <?php } ?>
</aside>
