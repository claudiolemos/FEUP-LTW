<?php
  include_once(__DIR__."/../database/connection.php");

  /**
   * Gets the number of votes of one post
   * @param  int $id id of the post
   * @return int|null number of votes or null if the post doesn't exist
   */
  function getPostVotes($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT votes FROM Posts WHERE id = ?');
    $stmt->execute(array($id));
    return $stmt->fetch()['votes'];
  }

  /**
   * Adds a vote to a post
   * @param int $user_id id of the user that is adding a vote
   * @param int $post_id id of the post that the vote is being added to
   * @param int $value   value of the vote (1 or -1)
   */
  function addVote($user_id, $post_id, $value){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO VoteOnPost VALUES (?,?,?)');
    $stmt->execute(array($user_id, $post_id, $value));
  }

  /**
   * Removes a vote from a post
   * @param  int $user_id id of the user that is removing a vote
   * @param  int $post_id id of the post that the vote is being removed from
   */
  function removeVote($user_id, $post_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('DELETE FROM VoteOnPost WHERE user_id = ? AND post_id = ?');
    $stmt->execute(array($user_id, $post_id));
  }

  /**
   * Gets correct post thumbnail, depending on wether it's a link or text post
   * @param  int $post_id id of the post
   * @return string link to the correct thumbnail
   */
  function getPostThumbnail($post_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT content as text, link FROM Posts WHERE id = ?');
    $stmt->execute(array($post_id));

    if($stmt->fetch()['text'] != null)
      return "images/text_post.png";
    else if($stmt->fetch()['link'] != null)
      return "images/link_post.png";
  }

  /**
   * Gets the correct class for a post vote button
   * @param  int    $user_id id of the user
   * @param  int    $post_id id of the post
   * @param  int    $value button's vote value (1 or -1)
   * @return string button class (upvote or downvote - if not voted | upvoted or downvoted - if voted)
   */
  function getVoteButtonClass($user_id, $post_id, $value){
    if($user_id == null)
      return $value == 1? "upvote" : "downvote";

    if(hasVoted($user_id, $post_id) == $value)
      return $value == 1? "upvoted" : "downvoted";
    else
      return $value == 1? "upvote" : "downvote";
  }

  /**
   * Gets the value of a vote, if a user has voted on a post
   * @param  int $user_id id of the user
   * @param  int $post_id id of the post
   * @return int value of the vote
   */
  function hasVoted($user_id, $post_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT value FROM VoteOnPost WHERE user_id = ? AND post_id = ?');
    $stmt->execute(array($user_id, $post_id));
    return $stmt->fetch()['value'];
  }

  /**
   * Returns a list of posts based on a type of sorting
   * @param  string $sort type of sort
   * @return array post id, title, content, link, date, votes username and channel
   */
  function getPosts($sort){
    switch ($sort) {
    case 'hot':
        return getHotPosts();
        break;
    case 'new':
        return getNewPosts();
        break;
    case 'top':
        return getTopPosts();
        break;
    }
  }

  /**
   * Returns a list of the most recent posts
   * @return array post id, title, content, link, date, votes, username and channel
   */
  function getNewPosts(){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel FROM Posts, Users, Channels WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id ORDER BY date DESC');
    $stmt->execute();
    return $stmt->fetchAll();
  }

  function getHotPosts(){}

  function getTopPosts(){}

?>
