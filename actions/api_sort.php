<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");

  if($_POST['subscribed'] == "true")
    echo json_encode(getSubscribedPosts($_POST['sort'], getUserID($_SESSION['username']), 0));
  else
    echo json_encode(getPosts($_POST['sort'], $_POST['id'],0));
?>
