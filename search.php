<?php
  include_once('includes/init.php');
  include_once('database/posts.php');
  include_once('database/comments.php');
  include_once('database/channels.php');
  include_once('database/users.php');

  if (!isset($_GET['query']))
    die("No search input!");

  $posts = searchPosts($_GET['query']);
  $comments = searchComments($_GET['query']);
  $users = searchUsers($_GET['query']);
  $channels = searchChannels($_GET['query']);

  include('templates/common/header.php');
  include('templates/common/sidebar.php');
  include('templates/search.php');
  include('templates/common/footer.php');
?>
