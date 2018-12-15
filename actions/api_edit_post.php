<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");

  $username = $_SESSION['username'];
  $post_id = $_POST['post_id'];
  $post_text = $_POST['post_text'];

  if(isset($username)){
    editPost($post_id, $post_text);
  }
?>
