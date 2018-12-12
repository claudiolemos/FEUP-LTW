<?php
  /**
   * Gets the karma of one user
   * @param  string $username username of the user
   * @return int|null user's karma or null if the user doesn't exist
   */
  function getUserKarma($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT karma FROM Users WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch()['karma'];
  }

  /**
   * Gets the karma of one user
   * @param  string $username username of the user
   * @return string|null user's karma or null if the user doesn't exist
   */
  function getUserCakeDay($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT cake_day FROM Users WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch()['cake_day'];
  }

  /**
   * Checks if login is correct
   * @param  string  $username user's username
   * @param  string  $password user's password
   * @return boolean true if login is correct or false if it's not
   */
  function isLoginCorrect($username, $password){
    $db = Database::instance()->db();
    $hash = hash('sha256', $password);
    $stmt = $db->prepare('SELECT username FROM Users WHERE username = ? AND password = ?');
    $stmt->execute(array($username, $hash));

    if($stmt->fetch() != null)
      return true;
    else
      return false;
  }

  /**
   * Checks if a user exists
   * @param  string $username user's username
   * @return boolean true if user exists or false if it doesn't
   */
  function userExists($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username FROM Users WHERE username = ?');
    $stmt->execute(array($username));

    if($stmt->fetch() != null)
      return true;
    else
      return false;
  }

  /**
   * Checks user's email
   * @param  string $username user's username
   * @param  string $email user's email
   * @return boolean true if email is the same or false if it doesn't
   */
  function userEmail($username, $email){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT email FROM Users WHERE username = ?');
    $stmt->execute(array($username));

    if($stmt->fetch()['email'] == $email)
      return true;
    else
      return false;
  }

  function updateUserPassword($username, $password){
    $db = Database::instance()->db();
    $hash = hash('sha256', $password);
    $stmt = $db->prepare('UPDATE Users SET password = ? where username = ?');
    $stmt->execute(array($hash, $username));
  }

  function updateUserEmail($username,  $email){
    $db = Database::instance()->db();
    $hash = hash('sha256', $password);
    $stmt = $db->prepare('UPDATE Users SET email = ? where username = ?');
    $stmt->execute(array($email, $username));
  }
?>
