<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");

  ob_start();
  var_dump($_POST);
  error_log(ob_get_clean(), 4);

  if($_POST['subscribed'] == "true")
    echo json_encode(getSubscribedPosts($_POST['sort'], getUserID($_SESSION['username'])));
  else
    echo json_encode(getPosts($_POST['sort'], $_POST['id']));
?>
