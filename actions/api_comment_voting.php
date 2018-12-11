<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/comments.php");
  include_once(__DIR__."/../database/users.php");

  $username = $_SESSION['username'];
  $comment_id = $_POST['comment_id'];
  $vote = $_POST['vote'];

  if(isset($username)){
    $user_id = getUserID($username);
    $value = hasVotedComment($user_id, $comment_id);

    if($value == $vote)
      removeCommentVote($user_id, $comment_id);
    else
      addCommentVote($user_id, $comment_id, $vote);
  }
?>
