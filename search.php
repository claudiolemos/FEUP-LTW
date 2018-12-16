<?php
  include_once('includes/init.php');
  include_once('database/posts.php');
  include_once('database/channels.php');
  include_once('database/users.php');
  include_once('database/comments.php');

  if (!isset($_GET['query']))
    die("No search input!");

  $searchPosts = searchPosts($_GET['query']);
  $searchUsers = searchUsers($_GET['query']);
  $searchChannels = searchChannels($_GET['query']);

  include('templates/common/header.php');
  include('templates/search.php');
  include('templates/common/footer.php');
?>
