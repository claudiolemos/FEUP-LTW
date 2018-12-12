<?php
  include_once('includes/init.php');
  include_once('database/posts.php');
  include_once('database/channels.php');

  if (!isset($_GET['id']))
    die("No channel id!");

  include('templates/common/header.php');
  include('templates/channels/sidebar.php');
  include('templates/channels/posts.php');
  include('templates/common/footer.php');
?>
