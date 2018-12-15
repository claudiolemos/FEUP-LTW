<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");

  $username = $_SESSION['username'];
  $post_id = $_POST['post_id'];

  if(isset($username)){
    deletePost($post_id);
  }
?>
