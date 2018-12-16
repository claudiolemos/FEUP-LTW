<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/channels.php");

  $title = $_POST['title'];
  $title = htmlspecialchars($title);
  $link = $_POST['link'];
  $link = htmlspecialchars($link);
  $user_id = getUserID($_POST['username']);
  $channel_id = getChannelID($_POST['channel']);

  $post_id = addLinkPost($title, $link, $user_id, $channel_id);

  header("Location:"."/../post.php/?id=".$post_id);
?>
