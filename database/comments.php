<?php

  /**
   * Gets the number of votes of one comment
   * @param  int $id id of the comment
   * @return int|null number of votes or null if the comment doesn't exist
   */
  function getCommentsVotes($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT votes FROM Comments WHERE id = ?');
    $stmt->execute(array($id));
    return $stmt->fetch()['votes'];
  }

  /**
   * Checks if user has voted on a comment
   * @param  int  $user_id id of the user
   * @param  int  $comment_id id of the comment
   * @return int|null value of the vote or null if the user didn't vote
   */
  function isCommentVoted($user_id, $comment_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT value FROM VoteOnComment WHERE user_id = ? AND comment_id = ?');
    $stmt->execute(array($user_id, $comment_id));
    return $stmt->fetch()['value'];
  }

  /**
   * Gets a comment's indent level based on the comments hierarchy
   * @param  int $id id of the comment
   * @return int comment's indent level
   */
  function getIndentLevel($id){
    $db = Database::instance()->db();
    $indent_level = 0;

    do{
      $stmt = $db->prepare('SELECT parent_id FROM Comments WHERE Comments.id = ?');
      $stmt->execute(array($id));
      $parent_id = $stmt->fetch()['parent_id'];

      if($parent_id != null){
        $indent_level++;
        $id = $parent_id;
      }

    }while($parent_id != null);

    return $indent_level;
  }
?>
