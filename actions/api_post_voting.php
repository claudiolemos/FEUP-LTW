<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");

  $username = $_SESSION['username'];
  $post_id = $_POST['post_id'];
  $vote = $_POST['vote'];

  if(isset($username)){
    $user_id = getUserID($username);
    $value = hasVoted($user_id, $post_id);

    if($value == $vote)
      removeVote($user_id, $post_id);
    else
      addVote($user_id, $post_id, $vote);
  }
?>
