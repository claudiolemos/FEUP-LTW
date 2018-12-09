<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");

  echo json_encode(getPosts($_SESSION['sort']));
?>
