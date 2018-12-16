<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");


  $username = strtolower(trim(strip_tags($_SESSION['username'])));
  $new_password = $_GET['new-pwd'];
  $curr_password = $_GET['curr-pwd'];
  $conf_new_password = $_GET['conf-new-pwd'];

  if($new_password != null && $curr_password != null && $conf_new_password != null)
    if(isLoginCorrect($username, $curr_password))
      updateUserPassword($username, $new_password);
  else {
    echo "error";
  }

  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
