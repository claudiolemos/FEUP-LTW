<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");

  // if user doesn't exist on the database

  if(isLoginCorrect($_POST['username'], $_POST['password']))
  	$_SESSION['username'] = $_POST['username'];
  else
  	$_SESSION['ERROR'] = 'Incorrect username or password';

  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
