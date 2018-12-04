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
   * Returns the proper class for a voting button on a post
   * @param  string $user_id id of the user
   * @param  int    $post_id id of the post
   * @param  int    $value button's vote value (1 or -1)
   * @return string button class (upvote or downvote - if not voted | upvoted or downvoted - if voted)
   */
  function getPostVoteButtonClass($username, $post_id, $value){
    if($username == null)
      return $value == 1? "upvote" : "downvote";

    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT value FROM VoteOnPost, Users WHERE user_id = id AND username = ? AND post_id = ?');
    $stmt->execute(array($username, $post_id));

    if($stmt->fetch()['value'] == $value)
      return $value == 1? "upvoted" : "downvoted";
    else
      return $value == 1? "upvote" : "downvote";
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
