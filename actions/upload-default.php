<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");


  $id = $_SESSION['username'];
  $image = "images/profile/default.svg";
  updateAvatar($_SESSION['username'], $image);

  header("Location:".$_SERVER['HTTP_REFERER']."");

?>
