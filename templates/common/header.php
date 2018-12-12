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
          <div class="login">
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
          </div>
          <div id="id01" class="modal">
            <form method="post" class="modal-content animate" action="actions/login.php">
              <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
              <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
              </div>
            </form>
          </div>
          <script>
          // Get the modal
          var modal = document.getElementById('id01');
          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }
        </script>
        <div class="register">
          <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>
        </div>
        <div id="id02" class="modal">
          <form method="post" class="modal-content animate" action="actions/register.php">
            <div class="imgcontainer">
              <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
            </div>
            <div class="container">
              <label for="uname"><b>Username</b></label>
              <input type="text" name="username" placeholder="Username" required>
                <label for="email"><b>Email</b></label>
                <input type="email" name="email" placeholder="Email" required>
              <label for="psw"><b>Password</b></label>
              <input type="password" name="password" placeholder="Password" required>
              <label for="conf_psw"><b>Comfirm Password</b></label>
              <input type="password" name="conf_psw" placeholder="Comfirm Password" required>
              <button type="submit">Register</button>
            </div>
          </form>
        </div>
        <script>
        // Get the modal
        var modal2 = document.getElementById('id02');
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal2) {
            modal.style.display = "none";
          }
        }
      </script>
      <?php }
      else{ ?>
        <div class="dropdown">
          <button class="dropbtn"><?=$_SESSION['username']?></button>
          <!-- <div class="avatar">
          <img src="images\reddito.png">
        </div> -->
        <div class="dropdown-content">
          <a href="profilepage.php?id=<?=$_SESSION['username']?>">Profile</a>
          <a href="settingspage.php?id=<?=$_SESSION['username']?>">Settings</a>
          <a href="actions/logout.php">Logout</a>
        </div>
      </div>
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
