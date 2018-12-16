<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/channels.php");

  $name = strtolower(trim(strip_tags($_POST['name'])));

  $name = htmlspecialchars($name);

  if(getChannel($name) != null)
    echo json_encode("invalid");
  else
    echo json_encode("valid");
?>
