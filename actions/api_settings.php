<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/users.php");

  $username = $_SESSION['username'];
  $password = $_POST['password'];

  if(isLoginCorrect($username, $password)){
  	echo json_encode("valid");
  }
  else
  	echo json_encode("password");
?>
