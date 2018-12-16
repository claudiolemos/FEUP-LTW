<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");


  $username = strtolower(trim(strip_tags($_SESSION['username'])));
  $new_email = strtolower(trim(strip_tags($_GET['new-email'])));
  $curr_email = strtolower(trim(strip_tags($_GET['curr-email'])));

  if($new_email != null && $curr_email != null)
    if(userEmail($username, $curr_email))
      updateUserEmail($username, $new_email);


  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
