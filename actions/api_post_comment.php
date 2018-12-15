<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/comments.php");


  $username = $_SESSION['username'];
  $post_id = $_POST['post_id'];
  $content = $_POST['content'];
  $parent_id = $_POST['parent_id'];
  $date = time(); 

  if(isset($username)){
    $user_id = getUserID($username);

    $newComment = addComment($content, $user_id, $post_id, $date, $parent_id, $username);
    echo json_encode($newComment);
  }

?>
