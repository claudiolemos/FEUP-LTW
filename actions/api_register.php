<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/users.php");

  $type = $_POST['type'];
  $value = strtolower(trim(strip_tags($_POST['value'])));

  if($type == "username"){
    echo json_encode(userExists($value));
  }
  else if($type == "email"){
    echo json_encode(emailExists($value) || !filter_var($value, FILTER_VALIDATE_EMAIL));
  }
?>
