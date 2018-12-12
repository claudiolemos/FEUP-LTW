<?php
  include_once("../includes/init.php");
  include_once("../database/users.php");

  if(!isLoginCorrect($_SESSION['username'], $_POST['pwd']))
  	$_SESSION['error'] = 'Incorrect password';

  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
