<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Reddito</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/layout.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href="css/comments.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <div id="logo">
        <img src="images/reddito.png" alt="Reddito logo" style="width:75px; height:75px;">
        <h1><a href="index.php">Reddito</a></h1>
      </div>
      <nav id="channels">
        <ul>
          <li><a href="index.php">Movies</a></li>
          <li><a href="index.php">World</a></li>
          <li><a href="index.php">Politics</a></li>
          <li><a href="index.php">Sports</a></li>
          <li><a href="index.php">Science</a></li>
          <li><a href="index.php">Weather</a></li>
        </ul>
      </nav>
      <div id="signup">
      <?php if(!isset($_SESSION['username'])) { ?>
            <form method="post" action="actions/login.php">
              <input type="text" name="username" placeholder="Username" required>
              <input type="password" name="password" placeholder="Password" required>
              <input type="submit" value="Login">
            </form>
            <a href="pages/register.php">Register</a>
      <?php }
          else{ ?>
            <a href="profilepage.php?id=<?=$_SESSION['username']?>"><?=$_SESSION['username']?></a>
            <a href="actions/logout.php">Logout</a>
      <?php } ?>
      </div>
    </header>
    <div id="sort">
      <ul>
        <li><a href="index.php">Hot</a></li>
        <li><a href="index.php">New</a></li>
        <li><a href="index.php">Top</a></li>
      </ul>
    </div>
    <div id="search">
      <form method="post" action="actions/search.php">
        <input type="text" name="search" placeholder="Search..." required>
        <input type="submit" value="Submit">
      </form>
    </div>
