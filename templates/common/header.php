<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Reddito</title>
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
        <img src="images/reddito.png" alt="Reddit logo" style="width:75px; height:75px;">
        <h1><a href="index.php">reddit</a></h1>
      </div>
      <nav id="channels">
        <ul>
          <li><a href="index.html">movies</a></li>
          <li><a href="index.html">music</a></li>
          <li><a href="index.html">gaming</a></li>
          <li><a href="index.html">news</a></li>
          <li><a href="index.html">sports</a></li>
        </ul>
      </nav>
      <div id="signup">
      <?php if(!isset($_SESSION['username'])) { ?>
            <form method="post" action="actions/login.php">
              <input type="text" name="username" placeholder="Username" required>
              <input type="password" name="password" placeholder="Password" required>
              <input type="submit" value="Login">
            </form>
            <a id="register" href="pages/register.php">Register</a>
            <p id="error_messages"> <?php echo $error?> </p>
      <?php }
          else{ ?>
            <a href="pages/profile?id=<?=$_SESSION['username']?>"><?=$_SESSION['username']?></a>
            <a href="actions/logout.php">Logout</a>
      <?php } ?>
      </div>
    </header>
    <div id="sort">
      <ul>
        <li><a href="index.html">Hot</a></li>
        <li><a href="index.html">New</a></li>
        <li><a href="index.html">Top</a></li>
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
