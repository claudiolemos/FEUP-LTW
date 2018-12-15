<?php
  include_once('includes/init.php');
  include_once('utils.php');
  include_once('database/posts.php');
  include_once('database/channels.php');

  include('templates/common/header.php');

  if(getChannelID($_GET['id']) != -1){
    $channel = getChannel($_GET['id']);
    include('templates/channels/sidebar.php');
    include('templates/channels/posts.php');
    include('templates/common/footer.php');
  }
  else{
    include('templates/404/channels.php');
  }
?>
