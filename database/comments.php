<?php
  include_once('database/connection.php');

  /**
   * Gets the number of votes of one comment
   * @param  int $comment_id id of the comment
   * @return int number of votes
   */
  function getCommentsVotes($comment_id){
    global $db;
    $stmt = $db->prepare('SELECT SUM(value) FROM VoteOnComment WHERE comment_id=?');
    $stmt->execute(array($comment_id));
    return $stmt->fetch();
  }
?>
