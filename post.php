<?php
  include_once('includes/init.php');
  include_once('database/comments.php');
  include_once('database/posts.php');

  if (!isset($_GET['id']))
    die("Wrong post id!");


  $post = getPostById($_GET['id']);
  $parent_comments = getParentComments($_GET['id']);


  include('templates/common/header.php');
  include('templates/common/sidebar.php');
  include('templates/post.php');
  include('templates/common/footer.php');
?>
