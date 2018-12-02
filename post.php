<?php
  include_once('database/connection.php');
  include_once('database/comments.php');
  include_once('database/posts.php');

  if (!isset($_GET['id']))
    die("No id!");


  $post = getPostById($_GET['id']);
  //$comments = getCommentsById($_GET['id']);


  include('templates/common/header.php');
  include('templates/post.php');
  include('templates/common/footer.php');
?>
