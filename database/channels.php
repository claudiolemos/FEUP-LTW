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
  /*
   * Gets the ID of a channel
   * @param  string $channel channel's name
   * @return int channel's ID. -1 if does not exist
   */
  function getChannelID($name){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT id FROM Channels WHERE name = ?');
    $stmt->execute(array($name));


    $channel_id = $stmt->fetch()['id'];

    if($channel_id != null)
      return $channel_id;
    else
      return -1;

  }
?>
