<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__.'/../database/users.php');

  $post_id = $_POST['id'];
  $post = getPost($post_id);

  $upvote = getVoteButtonClass(getUserID($_SESSION['username']), $post_id, 1);
  $votes = $post['votes'];
  $downvote = getVoteButtonClass(getUserID($_SESSION['username']), $post_id, -1);
  $thumbnail = getPostThumbnail($post_id);
  $title = $post['title'];
  $date = gmdate("Y-m-d", $post['date']);
  $username = $post['username'];
  $channel = $post['channel'];
  $comments = getNoComments($post_id);

  echo json_encode(array("upvote"=>$upvote, "votes"=>$votes, "downvote"=>$downvote, "thumbnail"=>$thumbnail, "title"=>$title, "date"=>$date, "username"=>$username, "channel"=>$channel, "comments"=>$comments));
?>
