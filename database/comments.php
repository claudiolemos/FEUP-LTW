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

  /**
   * Gets all comments on a post
   * @param  int $post_id id of the post
   * @return array of all comments on that post
   */
  function getPostComments($post_id){

    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Comments WHERE post_id = ? ORDER BY parent_id ASC');
    $stmt->execute(array($post_id));
    return $stmt->fetchAll();

  }

  /**
   * Gets the parent_id of a comment
   * @param  int $comment_id id of the comment
   * @return int id of parent comment
   */
  function getParentID($comment_id){

    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT parent_id FROM Comments WHERE Comments.id = ?');
    $stmt->execute(array($comment_id));
    $parent_id = $stmt->fetch()['parent_id'];

    return $parent_id;

  }



  /**
  * Gets all top level comments
  * @param  int $post_id id of the post
  * @return array of all top level comments on that post
  */
  function getParentComments($post_id){
      $db = Database::instance()->db();
      $stmt = $db->prepare('SELECT * FROM Comments WHERE post_id = ? AND parent_id IS NULL ORDER BY votes DESC');
      $stmt->execute(array($post_id));
      return $stmt->fetchAll();

  }


  /**
  * Gets all children comments of a comment
  * @param  int $parent_id id of the parent id
  * @return array of all child comments of that parent ID
  * TODO: MAX 4
  */
  function getChildComments($parent_id){

        $db = Database::instance()->db();
        $stmt = $db->prepare('SELECT * FROM Comments WHERE parent_id = ? ORDER BY votes DESC');
        $stmt->execute(array($parent_id));
        $childComments = $stmt->fetchAll();

        $uID = getUserID($_SESSION['username']);

        //if it has children
        if (!empty($childComments))
        {
            //echo "<ul>\n";
            foreach ($childComments as $comment) {
              //echo "<li>", $comment['content'], getChildComments($comment['id']), "</li>\n";

              echo "<div class=".'user-comment'." id=".'user-comment-'. $comment['id'] .">";
                echo "<div class='voting comment-voting'>";
                  echo "<button class=".getCommentVoteButtonClass($uID, $comment['id'], 1)."></button>";
                  echo "<span class='votes comment-votes'>".$comment['votes']."</span>";
                  echo "<button class=".getCommentVoteButtonClass($uID, $comment['id'], -1)."></button>";
                echo "</div>";
                echo "<span id=".'comment-info'.">". '<a href="/profile.php/?id='.getUserName($comment['user_id']).'">'.getUserName($comment['user_id']).'</a>' . " - " . gmdate("Y-m-d", $comment['date']);
                if ($uID == $comment['user_id']) {
                  echo " - <img id=".'user-edit-'. $comment['id'] ." class=".'comment-edit'." src=".'/images/edit.png'.">";
                  echo "<img id=".'user-delete-'. $comment['id'] ." class=".'comment-trashcan'." src=".'/images/garbage.png'.">";
                }
                echo "</span>";
                echo "<div class=".'comment-body'.">". $comment['content'] . "</div>";
                echo '<div class="write-comment-div" id="write-comment-div-'. $comment['id'] .'">';
                echo "<button type=".'submit'." class=".'replyBtn'." value=". $comment['post_id'] . "-" .$comment['id']. "-" . getParentID($comment['id']) . ">". 'Reply' . "</button>";
                echo "</div>";

                getChildComments($comment['id']);

              echo "</div>";

            }








            //echo "</ul>\n";

        }
          //else no child comments
    }


  /**
   * Adds a comment
   * @param  string  $content content of the comment
   * @param  int  $user_id id of the user
   * @param  int  $post_id id of the post
   * @param  date  $date comment date
   * @param  int|undefined $parent_id id of the parent of this comment. undefined if top-level comment.
   * @param  int  $username user's username 
   * @return array post_id, id of new comment and parent id
   */
    function addComment($content, $user_id, $post_id, $date, $parent_id, $username){
      $db = Database::instance()->db();
      $stmt = $db->prepare('INSERT INTO Comments VALUES (NULL,?,?,?,?,?,0)');


      if($parent_id == undefined)
        $parent_id = NULL;


      $stmt->execute(array($content, $user_id, $post_id, $date, $parent_id));


      $userProfile = '<a href="/profile.php/?id='.$username.'">'.$username.'</a>';

      $postID_commentID_parentID = array("post_id" => $post_id, "comment_id" => $db->lastInsertId(), "parent_id" => $parent_id, "user_profile" => $userProfile, "date" => gmdate("Y-m-d",$date));

      return $postID_commentID_parentID;


    }


    /**
   * Gets the correct class for a comment vote button
   * @param  int    $user_id id of the user
   * @param  int    $comment_id id of the comment
   * @param  int    $value button's vote value (1 or -1)
   * @return string button class (upvote or downvote - if not voted | upvoted or downvoted - if voted)
   */
  function getCommentVoteButtonClass($user_id, $comment_id, $value){
    if($user_id == null)
      return $value == 1? "upvote" : "downvote";

    if(hasVotedComment($user_id, $comment_id) == $value)
      return $value == 1? "upvoted" : "downvoted";
    else
      return $value == 1? "upvote" : "downvote";
  }

  /**
   * Gets the value of a vote, if a user has voted on a comment
   * @param  int $user_id id of the user
   * @param  int $comment_id id of the comment
   * @return int value of the vote
   */
  function hasVotedComment($user_id, $comment_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT value FROM VoteOnComment WHERE user_id = ? AND comment_id = ?');
    $stmt->execute(array($user_id, $comment_id));
    return $stmt->fetch()['value'];
  }


  /**
   * Adds a vote to a comment
   * @param int $user_id id of the user that is adding a vote
   * @param int $comment_id id of the comment that the vote is being added to
   * @param int $value   value of the vote (1 or -1)
   */
  function addCommentVote($user_id, $comment_id, $value){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO VoteOnComment VALUES (?,?,?)');
    $stmt->execute(array($user_id, $comment_id, $value));
  }

  /**
   * Removes a vote from a comment
   * @param  int $user_id id of the user that is removing a vote
   * @param  int $comment_id id of the comment that the vote is being removed from
   */
  function removeCommentVote($user_id, $comment_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM VoteOnComment WHERE user_id = ? AND comment_id = ?');
    $stmt->execute(array($user_id, $comment_id));
  }

  /**
   * Removes a comment (comment stays in DB and website, text is changed to [DELETED])
   * @param  int $comment_id id of the comment that is being removed
   */
  function deleteComment($comment_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Comments SET content = "[DELETED]" WHERE id = ?');
    $stmt->execute(array($comment_id));
  }

  /**
   * edits a comment 
   * @param  int $comment_id id of the comment that is being edited
   * @param  string $comment new comment
   */
  function editComment($comment_id, $comment){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Comments SET content = ? WHERE id = ?');
    $stmt->execute(array($comment,$comment_id));
  }


?>
