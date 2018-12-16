<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");


  $id = $_SESSION['username'];
  $image = "images/profile/$id.jpg";
  $path = "../images/profile/$id.jpg";
  
  if(is_uploaded_file($_FILES['image']['tmp_name'])){
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    updateAvatar($_SESSION['username'], $image);
  }
  else{
    echo ("fail!");
  }

  header("Location:".$_SERVER['HTTP_REFERER']."");

?>
