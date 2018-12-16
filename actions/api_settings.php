<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/users.php");

  $username = $_SESSION['username'];
  $type = $_POST['type'];
  $value = $_POST['value'];

  if($type == "password"){
    if(isLoginCorrect($username, $value)){
    	echo json_encode("valid");
    }
    else
    	echo json_encode("password");
  }

  else if ($type == "email") {
    if(userEmail($username, $value))
      echo json_encode("valid");
    else {
      echo json_encode("email");
    }
  }
?>
