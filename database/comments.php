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
  * Gets all top level comments
  * @param  int $post_id id of the post
  * @return array of all top level comments on that post
  */
  function getParentComments($post_id){
      $db = Database::instance()->db();
      $stmt = $db->prepare('SELECT * FROM Comments WHERE post_id = ? AND parent_id IS NULL');
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
        $stmt = $db->prepare('SELECT * FROM Comments WHERE parent_id = ?');
        $stmt->execute(array($parent_id));
        $childComments = $stmt->fetchAll();
        
        //if it has children
        if (!empty($childComments))
        {
            echo "<ul>\n";
            foreach ($childComments as $comment) {
              echo "<li>", $comment['content'], getChildComments($comment['id']), "</li>\n";
            }
                
            echo "</ul>\n";
        }
          //else no child comments
    }






?>
