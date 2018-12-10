<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>Reddit</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/layout.css" rel="stylesheet">
  <link href="../css/responsive.css" rel="stylesheet">
  <link href="../css/comments.css" rel="stylesheet">
  <link href="../css/forms.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Comfortaa|Open+Sans" rel="stylesheet">
</head>
<body>
  <header>
    <div id="logo">
      <img src="images/reddit.png" alt="Reddit logo" style="width:75px; height:75px;">
      <h1><a href="index.php">reddit</a></h1>
    </div>
    <nav id="channels">
      <ul>
        <li><a href="index.php">movies</a></li>
        <li><a href="index.php">music</a></li>
        <li><a href="index.php">gaming</a></li>
        <li><a href="index.php">news</a></li>
        <li><a href="index.php">sports</a></li>
      </ul>
    </nav>
    <div id="signup">
      <?php if(!isset($_SESSION['username'])) { ?>
        <div class="login">
          <button onclick="document.getElementById('login-pop-up').style.display='block'" style="width:auto;">Login</button>
        </div>
        <div id="login-pop-up" class="pop-up">
          <form method="post" class="pop-up-content animate" action="actions/login.php">
            <div class="imgcontainer">
              <span onclick="document.getElementById('login-pop-up').style.display='none'" class="close">&times;</span>
            </div>
            <div class="container">
              <label><a>Username</a></label>
              <input type="text" name="username" placeholder="Username" required>
              <label><a>Password</a></label>
              <input type="password" name="password" placeholder="Password" required>
              <button type="submit">Login</button>
            </div>
          </form>
        </div>
        <div class="register">
          <button onclick="document.getElementById('register-pop-up').style.display='block'" style="width:auto;">Register</button>
        </div>
        <div id="register-pop-up" class="pop-up">
          <form method="post" class="pop-up-content animate" action="actions/register.php">
            <div class="imgcontainer">
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
            <a href="profilepage.php?id=<?=$_SESSION['username']?>">Profile</a>
            <a href="#">Settings</a>
            <a href="actions/logout.php">Logout</a>
          </div>
        </div>
      <?php } ?>
    </div>
  </header>
  <div id="sort">
    <ul>
      <li name="new">New</a></li>
      <li name="top">Top</a></li>
      <li name="controversial">Controversial</a></li>
    </ul>
  </div>
  <div id="search">
    <form method="post" action="actions/search.php">
      <input type="text" name="search" placeholder="Search..." required>
      <input type="submit" value="Submit">
    </form>
  </div>
  <aside id="sidebar">
    <h1>Vestibulum congue blandit</h1>
    <h3>Description</h3>
    <p>Proin lectus felis, fringilla nec magna ut, vestibulum volutpat elit. Suspendisse in quam sed tellus fringilla luctus quis non sem. Aenean varius molestie justo, nec tincidunt massa congue vel. Sed tincidunt interdum laoreet. Vivamus vel odio bibendum, tempus metus vel.</p>
    <p>Proin lectus felis, fringilla nec magna ut, vestibulum volutpat elit. Suspendisse in quam sed tellus fringilla luctus quis non sem. Aenean varius molestie justo, nec tincidunt massa congue vel. Sed tincidunt interdum laoreet. Vivamus vel odio bibendum, tempus metus vel.</p>
    <p>Proin lectus felis, fringilla nec magna ut, vestibulum volutpat elit. Suspendisse in quam sed tellus fringilla luctus quis non sem. Aenean varius molestie justo, nec tincidunt massa congue vel. Sed tincidunt interdum laoreet. Vivamus vel odio bibendum, tempus metus vel.</p>
  </aside>
