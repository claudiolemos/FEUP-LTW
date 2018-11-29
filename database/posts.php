<?php
  include_once('connection.php');

  /**
   * Gets the number of votes of one post
   * @param  int $post_id id of the post
   * @return int|null number of votes or null if the post doesn't exist
   */
  function getPostVotes($post_id){
    global $db;
    $stmt = $db->prepare('SELECT SUM(value) as votes FROM VoteOnPost WHERE post_id=?');
    $stmt->execute(array($post_id));
    return $stmt->fetch()['votes'];
  }

  /**
   * Checks if user has voted on a post
   * @param  int  $user_id id of the user
   * @param  int  $post_id id of the post
   * @return int|null value of the vote or null if the user didn't vote
   */
  function isPostVoted($user_id, $post_id){
    global $db;
    $stmt = $db->prepare('SELECT value FROM VoteOnPost WHERE user_id = ? AND post_id = ?');
    $stmt->execute(array($user_id, $post_id));
    return $stmt->fetch()['value'];
  }
?>
