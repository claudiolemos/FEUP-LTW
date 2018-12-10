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
?>
