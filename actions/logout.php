<?php
  include_once("../includes/init.php");
  unset($_SESSION['username']);
  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
