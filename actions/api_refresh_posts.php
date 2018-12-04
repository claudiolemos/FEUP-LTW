<?php
  include_once(__DIR__."/../database/connection.php");
  include_once(__DIR__."/../database/posts.php");

  $posts = getPosts();

  echo json_encode($posts);
?>
