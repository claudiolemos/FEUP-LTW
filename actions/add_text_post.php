<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/channels.php");

  $title = $_POST['title'];
  $content = $_POST['content'];
  $user_id = getUserID($_POST['username']);
  $channel_id = getChannelID($_POST['channel']);

  $post_id = addTextPost($title, $content, $user_id, $channel_id);

  header("Location:"."/../post.php/?id=".$post_id);
?>
