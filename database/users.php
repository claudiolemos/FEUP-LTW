<?php
  include_once('connection.php');

  /**
   * Gets the karma of one user
   * @param  int $user_id id of the user
   * @return int|null user's karma or null if the user doesn't exist
   */
  function getUserKarma($user_id){
    global $db;
    $stmt = $db->prepare('SELECT SUM(votes) as karma
                          FROM (
                          	SELECT VoteOnPost.post_id as id, SUM(VoteOnPost.value) as votes
                          	FROM Users, Posts, VoteOnPost
                          	WHERE Users.id = Posts.user_id AND Posts.id = VoteOnPost.post_id AND Posts.user_id = ?
                          	GROUP BY VoteOnPost.post_id

                            UNION ALL

                          	SELECT VoteOnComment.comment_id as id, SUM(VoteOnComment.value) as votes
                          	FROM Users, Comments, VoteOnComment
                          	WHERE Users.id = Comments.user_id AND Comments.id = VoteOnComment.comment_id AND Comments.user_id = ?
                          	GROUP BY VoteOnComment.comment_id
                          )');
    $stmt->execute(array($user_id, $user_id));
    return $stmt->fetch()['karma'];
  }
?>
