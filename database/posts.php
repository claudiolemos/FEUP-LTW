<?php
  include_once(__DIR__."/../database/connection.php");

  /**
   * Gets the number of votes of one post
   * @param  int $id id of the post
   * @return int number of votes
   */
  function getPostVotes($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT votes FROM Posts WHERE id = ?');
    $stmt->execute(array($id));
    return $stmt->fetch()['votes'];
  }

  /**
   * Gets the number of comments of one post
   * @param  int $id id of the post
   * @return int number of comments
   */
  function getNoComments($id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT count(Comments.id) as comments FROM Posts, Comments WHERE Comments.post_id = Posts.id AND Posts.id = ?');
    $stmt->execute(array($id));
    return $stmt->fetch()['comments'];
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
   * Returns a post from the databse
   * @param  int $post_id id of the post
   * @return array post id, title, content, link, date, votes, username and channel
   */
  function getPost($post_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                          FROM Posts, Users, Channels
                          WHERE Posts.id = ? AND Posts.channel_id = Channels.id AND Posts.user_id = Users.id');
    $stmt->execute(array($post_id));
    return $stmt->fetch();
  }

  /**
   * Returns a list of posts based on a type of sorting
   * @param  string $sort type of sort
   * @return array post id, title, content, link, date, votes, username and channel
   */
  function getPosts($sort){
    $db = Database::instance()->db();

    switch ($sort) {
    case "new":
        $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                              FROM Posts, Users, Channels
                              WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id
                              ORDER BY date DESC');
        break;
    case "top":
        $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                              FROM Posts, Users, Channels
                              WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id
                              ORDER BY votes DESC, date ASC');
        break;
    case "controversial":
        $stmt = $db->prepare('SELECT p1.id, p1.title, p1.content, p1.link, p1.date, p1.votes, Users.username, Channels.name as channel, comments
                              FROM Posts p1, Users, Channels, (
	                               SELECT p2.id as id_post, count(Comments.id) as comments FROM Posts p2, Comments WHERE Comments.post_id = p2.id GROUP BY p2.id
                              )
                              WHERE p1.user_id = Users.id AND p1.channel_id = Channels.id AND p1.id = id_post
                              ORDER BY comments DESC, votes DESC');
        break;
    }

    $stmt->execute();
    return $stmt->fetchAll();

  }

  /**
  * Returns a post
  * @param  int $post_id id of the post
  * @return entire post information
  */
  function getPostById($post_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM Posts WHERE id = ?');
    $stmt->execute(array($post_id));
    return $stmt->fetch();

  }





?>
