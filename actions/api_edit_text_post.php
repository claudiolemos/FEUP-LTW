<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/channels.php");

  $title = $_POST['title'];
  $content = $_POST['content'];
  $post_id = $_POST['post_id'];

  editTextPost($post_id, $title, $content);

  header("Location:"."/../post.php/?id=".$post_id);
?>
