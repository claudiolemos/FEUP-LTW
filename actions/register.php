<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/users.php");

  $username = strtolower(trim(strip_tags($_POST['username'])));
  $username = htmlspecialchars($username);
  $password = $_POST['password'];
  $password = htmlspecialchars($password);
  $email = strtolower(trim(strip_tags($_POST['email'])));
  $email = htmlspecialchars($email);

  
  if(!userExists($_POST['username'])){
    addUser($username, $password, $email);
    $_SESSION['username'] = $username;
  }

  header("Location:".$_SERVER['HTTP_REFERER']."");
?>
