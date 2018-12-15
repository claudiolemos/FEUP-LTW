<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/channels.php");

  $title = $_POST['title'];
  $link = $_POST['link'];
  $post_id = $_POST['post_id'];

  editLinkPost($post_id, $title, $link);

  header("Location:"."/../post.php/?id=".$post_id);
?>
