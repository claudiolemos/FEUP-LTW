<?php
  include_once(__DIR__."/../includes/init.php");
  session_destroy();
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
