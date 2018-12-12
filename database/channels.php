<?php
  /**
   * Gets a channel
   * @param  string name name of the channel
   * @return array  contains all the channel info
   */
  function getChannel($name){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Channels WHERE name = ?');
    $stmt->execute(array($name));
    return $stmt->fetch();
  }

  /**
   * Gets a channel id from their name
   * @param  string $channel channel's name
   * @return int channel's id
   */
  function getChannelID($channel){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT id FROM Channels WHERE name = ?');
    $stmt->execute(array($channel));
    return $stmt->fetch()['id'];
  }

  function addChannel($channel_name){

  }

  /**
   * Gets the number of subscribers of one channel
   * @param  int $id id of the channel
   * @return int number of subscribers
   */
  function getChannelSubscribers($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT count(*) as subscribers
                          FROM Channels, Subscriptions
                          WHERE Channels.id = ? AND Subscriptions.channel_id = ?');
    $stmt->execute(array($id, $id));
    return $stmt->fetch()['subscribers'];
  }

  /**
   * Searches the channels
   * @param  string $query what the user is searching for
   * @return array  channels that match the query
   */
  function searchChannels($query){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT name
                          FROM Channels
                          WHERE name LIKE ?');
    $stmt->execute(array("%$query%"));
    return $stmt->fetchAll();
  }


  /**
   * Tells if a user is subscribed to a channel
   * @param  string] $user    username
   * @param  string  $channel channel's name
   * @return boolean true if subscribed, false if not
   */
  function isSubscribed($user, $channel){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT Users.username, Channels.name FROM Users, Channels, Subscriptions WHERE Users.id = Subscriptions.user_id AND Channels.id = Subscriptions.channel_id AND Users.username = ? AND Channels.name = ?');
    $stmt->execute(array($user, $channel));
    return $stmt->fetch() == null? false : true;
  }

  /**
   * Adds or removes a suscription depending on wether the user is already subscribed or not
   * @param  int $user       user's username
   * @param  int $user_id    user's id
   * @param  int $channel    channel's name
   * @param  int $channel_id channel's id
   * @return string new value for the subscribe button
   */
  function subscribe($user, $user_id, $channel, $channel_id){
    $db = Database::instance()->db();

    if(isSubscribed($user, $channel)){
      $stmt = $db->prepare('DELETE FROM Subscriptions WHERE user_id = ? AND channel_id = ?');
      $stmt->execute(array($user_id, $channel_id));
      return Subscribe;
    }
    else{
      $stmt = $db->prepare('INSERT INTO Subscriptions VALUES (?,?)');
      $stmt->execute(array($user_id, $channel_id));
      return Unsubscribe;
    }
  }

  /**
   * Returns top 5 subscribed channels
   * @return array channel's name
   */
  function getTopChannels(){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT Channels.name, count(*) as subscribers
                          FROM Channels, Subscriptions
                          WHERE Subscriptions.channel_id = Channels.id
                          GROUP BY name
                          ORDER BY subscribers DESC
                          LIMIT 5');
    $stmt->execute();
    return $stmt->fetchAll();
  }

?>
