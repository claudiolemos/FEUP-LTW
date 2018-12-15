<?php
  include_once('includes/init.php');
  include_once('database/connection.php');
  include_once('database/comments.php');
  include_once('database/posts.php');
  include_once('database/users.php');
  include_once('database/channels.php');
  include_once('utils.php');

  include('templates/common/header.php');

  if(($post = getPostById($_GET['id'])) != null){
    if(isset($_SESSION['username']))
      $uID = getUserID($_SESSION['username']);

    $parent_comments = getParentComments($_GET['id']);
    $channel = getChannelFromPost($_GET['id']);

    include('templates/channels/sidebar.php');
    include('templates/post.php');
    include('templates/common/footer.php');
  }
  else
    include('templates/404/posts.php');
?>
