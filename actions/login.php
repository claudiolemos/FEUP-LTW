<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");

  if(userExists($_POST['username'])){
    if(isLoginCorrect($_POST['username'], $_POST['password']))
    	$_SESSION['username'] = $_POST['username'];
    else
    	$_SESSION['error'] = 'Incorrect password';
  }
  else
    $_SESSION['error'] = 'Incorrect username';

  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
