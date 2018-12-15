<?php
  include_once(__DIR__.'/../../database/channels.php');
  $topChannels = getTopChannels();
?>


<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Reddit</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/style.css" rel="stylesheet">
  <link href="/css/layout.css" rel="stylesheet">
  <link href="/css/responsive.css" rel="stylesheet">
  <link href="/css/comments.css" rel="stylesheet">
  <link href="/css/forms.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa|Open+Sans" rel="stylesheet">
</head>
<body>
  <header>
    <div id="logo">
      <a href="/"><img src="/images/reddit.png" alt="Reddit logo" style="width:75px; height:75px;"></a>
      <h1><a href="/">reddit</a></h1>
    </div>
    <nav id="channels">
      <ul>
        <?php foreach($topChannels as $channel) { ?>
          <li><a href="/channel.php/?id=<?=$channel['name']?>"><?=$channel['name']?></a></li>
        <?php } ?>
      </ul>
    </nav>
    <div id="signup">
      <?php if(!isset($_SESSION['username'])) { ?>
        <div class="login">
          <button onclick="document.getElementById('login-pop-up').style.display='block'" style="width:auto;">Login</button>
        </div>
        <div id="login-pop-up" class="pop-up">
          <form method="post" class="pop-up-content animate" action="actions/login.php">
            <div class="close-button">
              <span onclick="document.getElementById('login-pop-up').style.display='none'" class="close">&times;</span>
            </div>
            <div class="container">
              <label><a>Username</a></label>
              <input type="text" name="username" placeholder="Username" required>
              <label><a>Password</a></label>
              <input type="password" name="password" placeholder="Password" required>
              <button type="submit">Login</button>
              <button name="register" onclick="document.getElementById('login-pop-up').style.display='none', document.getElementById('register-pop-up').style.display='block'" type="button">Register</button>
            </div>
          </form>
        </div>
        <div id="register-pop-up" class="pop-up">
          <form method="post" class="pop-up-content animate" action="actions/register.php">
            <div class="close-button">
              <span onclick="document.getElementById('register-pop-up').style.display='none'" class="close">&times;</span>
            </div>
            <div class="container">
              <label><a>Username</a></label>
              <input type="text" name="username" placeholder="Username" required>
              <label><a>Email</a></label>
              <input type="email" name="email" placeholder="Email" required>
              <label><a>Password</a></label>
              <input type="password" name="password" placeholder="Password" required>
              <label><a>Confirm Password</a></label>
              <input type="password" name="confirm" placeholder="Password" required>
              <button type="submit">Register</button>
            </div>
          </form>
        </div>
      <?php }
      else{ ?>
        <div class="user-dropdown">
          <button class="dropdown-button"><?=$_SESSION['username']?></button>
          <div class="user-dropdown-content">
            <a href="/profilepage.php?id=<?=$_SESSION['username']?>">Profile</a>
            <a href="#">Settings</a>
            <a href="/actions/logout.php">Logout</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </header>
