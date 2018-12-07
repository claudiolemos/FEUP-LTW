<?php
  /**
   * Gets the karma of one user
   * @param  int $id id of the user
   * @return int|null user's karma or null if the user doesn't exist
   */
  function getUserKarma($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT karma FROM Users WHERE id = ?');
    $stmt->execute(array($id));
    return $stmt->fetch()['karma'];
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
   * Gets an user id from their username
   * @param  string $username user's username
   * @return int user's id
   */
  function getUserID($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT id FROM Users WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch()['id'];
  }
?>
