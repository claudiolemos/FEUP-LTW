<?php
  include_once('database/connection.php');
  include_once('database/comments.php');
  include_once('database/posts.php');

  if (!isset($_GET['id']))
    die("Wrong post id!");


  $post = getPostById($_GET['id']);
  $comments = getPostComments($_GET['id']);
  $parent_comments = getParentComments($_GET['id']);

  foreach ($parent_comments as $comment) {
    echo "<ul>\n";
    echo "<li>", $comment['content'], "</li>\n";
    getChildComments($comment['id']);
  }
  echo "</ul>\n";

  include('templates/common/header.php');
  include('templates/post.php');
  include('templates/common/footer.php');
?>
