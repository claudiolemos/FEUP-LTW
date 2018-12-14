<?php
  include_once('includes/init.php');
  include_once('utils.php');
  include_once('database/posts.php');
  include_once('database/channels.php');


  include('templates/common/header.php');

  if(isset($_GET['id'])){
    include('templates/channels/sidebar.php');
    include('templates/channels/posts.php');
  }
  else if(!isset($_GET['id'])){
    include('templates/404/404.php');

  }

  include('templates/common/footer.php');
?>
