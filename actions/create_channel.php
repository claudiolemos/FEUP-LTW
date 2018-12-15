<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/channels.php");

  $name = strtolower(trim(strip_tags($_POST['name'])));
  $name = htmlspecialchars($name);
  $description = $_POST['description'];
  $description = htmlspecialchars($description);

  createChannel($name, $description);

  header("Location:"."/../channel.php/?id=".$name);
?>
