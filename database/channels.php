<?php
  include_once('connection.php');

  /**
   * Gets the number of subscribers of one channel
   * @param  int $channel_id id of the channel
   * @return int number of subscribers
   */
  function getChannelSubscribers($channel_id){
    global $db;
    $stmt = $db->prepare('SELECT count(*) as subscribers
                          FROM Channels, Subscriptions
                          WHERE Channels.id = ? AND Subscriptions.channel_id = ?');
    $stmt->execute(array($channel_id, $channel_id));
    return $stmt->fetch()['subscribers'];
  }
?>
