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

  function addUser($username, $password, $email){
    $db = Database::instance()->db();
    $hash = hash('sha256', $password);
    $stmt = $db->prepare('INSERT INTO Users VALUES (NULL, ?, ?, ?, ?, 0, ?)');
    $stmt->execute(array($username, $email, $hash, time(), "/images/profile/default.svg"));
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
   * Checks if email belongs to user
   * @param  string $username user's username
   * @param  string $email user's email
   * @return boolean true if email is the same or false if it's not
   */
  function userEmail($username, $email){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT email FROM Users WHERE username = ?');
    $stmt->execute(array($username));
    return ($stmt->fetch()['email'] == $email);
  }

  /**
   * Checks if a email exists
   * @param  string $email user's email
   * @return boolean true if email exists or false if it doesn't
   */
  function emailExists($email){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT email FROM Users WHERE email = ?');
    $stmt->execute(array($email));
    return ($stmt->fetch() != null);
  }

  function updateUserPassword($username, $password){
    $db = Database::instance()->db();
    $hash = hash('sha256', $password);
    $stmt = $db->prepare('UPDATE Users SET password = ? where username = ?');
    $stmt->execute(array($hash, $username));
  }

  function updateUserEmail($username,  $email){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Users SET email = ? where username = ?');
    $stmt->execute(array($email, $username));
  }

  function updateAvatar($username,  $avatar){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Users SET avatar = ? where username = ?');
    $stmt->execute(array($avatar, $username));
  }

  function getAvatar($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT avatar FROM Users WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetch()['avatar'];
  }

  /**
   * Gets the ID of an user
   * @param  string $username user's username
   * @return int usernames ID.
   */
  function getUserID($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT id FROM Users WHERE username = ?');
    $stmt->execute(array($username));


    $user_id = $stmt->fetch()['id'];
    if($user_id != null)
      return $user_id;
    else
      return -1;
  }

  /**
   * Gets the username of an user
   * @param  int $id user's id
   * @return string user's username.
   */
  function getUserName($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username FROM Users WHERE id = ?');
    $stmt->execute(array($id));

    return $stmt->fetch()['username'];


  }


  /**
   * Searches the users
   * @param  string $query what the user is searching for
   * @return array  users that match the query
   */
  function searchUsers($query){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT username
                          FROM Users
                          WHERE username LIKE ?');
    $stmt->execute(array("%$query%"));
    return $stmt->fetchAll();
  }

?>
