<?php
  include_once('database/connection.php');

  /**
   * Gets the number of votes of one post
   * @param  int $post_id id of the post
   * @return int number of votes
   */
  function getPostVotes($post_id){
    global $db;
    $stmt = $db->prepare('SELECT SUM(value)
                          FROM VoteOnPost
                          WHERE post_id=?');
    $stmt->execute(array($post_id));
    return $stmt->fetchAll();
  }
?>
