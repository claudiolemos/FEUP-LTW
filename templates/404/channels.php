<div id="error-block">
  <img src="/images/404.png">
  <p class="error-message">Uh-oh! You took a wrong turn.</p>
  <?php if($_GET['id'] != "") {?>
    <?php if(isset($_SESSION['username'])) {?>
      <div class="create-channel">
        <button onclick="document.getElementById('create-channel-pop-up').style.display='block'" >Create Channel</button>
      </div>
      <div id="create-channel-pop-up" class="pop-up">
        <form method="post" class="pop-up-content animate" action="/../actions/create_channel.php">
          <div class="close-button">
            <span onclick="document.getElementById('create-channel-pop-up').style.display='none'" class="close">&times;</span>
          </div>
          <div class="container">
            <label><a>Name</a></label>
            <input type="text" name="name" placeholder="<?=$_GET['id']?>" required>
            <label><a>Description</a></label>
            <textarea name="description" rows="5" placeholder="Description" required></textarea>
            <button type="submit">Create channel</button>
          </div>
        </form>
      </div>
    <?php }?>
  <?php }?>
</div>
