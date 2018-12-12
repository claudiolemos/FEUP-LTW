<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/channels.php");
  include_once(__DIR__."/../database/users.php");

  $user_id = getUserID($_POST['username']);
  $channel_id = getChannelID($_POST['channel']);

  echo json_encode(subscribe($_POST['username'], $user_id, $_POST['channel'], $channel_id));
?>
