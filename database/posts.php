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
    $stmt = $db->prepare('SELECT content as text FROM Posts WHERE id = ?');
    $stmt->execute(array($post_id));

    if($stmt->fetch()['text'] != null)
      return "/images/text_post.png";
    else
      return "/images/link_post.png";
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
   * @param  string $channel if not null, the channel from where to get posts
   * @param  int $offset current increment
   * @return array post id, title, content, link, date, votes, username and channel
   */
  function getPosts($sort, $channel = null, $offset){
    $db = Database::instance()->db();

    if($channel == null){
      switch ($sort) {
        case "new":
            $stmt = $db->prepare('
                              SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                                  FROM Posts, Users, Channels
                                  WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id
                                  ORDER BY date DESC LIMIT 5 OFFSET ? ');
            break;
        case "top":
            $stmt = $db->prepare('
                          SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                                  FROM Posts, Users, Channels
                                  WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id
                                  ORDER BY votes DESC, date ASC LIMIT 5 OFFSET ? ');
            break;
        case "controversial":
            $stmt = $db->prepare('
                        SELECT p1.id, p1.title, p1.content, p1.link, p1.date, p1.votes, Users.username, Channels.name as channel, comments
                                  FROM Posts p1, Users, Channels, (
    	                               SELECT p2.id as id_post, count(Comments.id) as comments FROM Posts p2, Comments WHERE Comments.post_id = p2.id GROUP BY p2.id
                                  )
                                  WHERE p1.user_id = Users.id AND p1.channel_id = Channels.id AND p1.id = id_post
                                  ORDER BY comments DESC, votes DESC LIMIT 5 OFFSET ?');
            break;
      }

      $stmt->execute(array($offset));
    }
    else{
      switch ($sort) {
        case "new":
            $stmt = $db->prepare('
              SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                                  FROM Posts, Users, Channels
                                  WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id AND Channels.name = ?
                                  ORDER BY date DESC LIMIT 5 OFFSET ?');
            break;
        case "top":
            $stmt = $db->prepare('
              SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                                  FROM Posts, Users, Channels
                                  WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id AND Channels.name = ? 
                                  ORDER BY votes DESC, date ASC LIMIT 5 OFFSET ?');
            break;
        case "controversial":
            $stmt = $db->prepare('
              SELECT p1.id, p1.title, p1.content, p1.link, p1.date, p1.votes, Users.username, Channels.name as channel, comments
                                  FROM Posts p1, Users, Channels, (
    	                               SELECT p2.id as id_post, count(Comments.id) as comments FROM Posts p2, Comments WHERE Comments.post_id = p2.id GROUP BY p2.id
                                  )
                                  WHERE p1.user_id = Users.id AND p1.channel_id = Channels.id AND p1.id = id_post AND Channels.name = ?
                                  ORDER BY comments DESC, votes DESC LIMIT 5 OFFSET ? ');
            break;
      }

      $stmt->execute(array($channel, $offset));
    }

    return $stmt->fetchAll();
  }

  function getSubscribedPosts($sort, $user_id, $offset){
    $db = Database::instance()->db();

    switch ($sort) {
      case "new":
          $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                                FROM Posts, Users, Channels, Subscriptions
                                WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id AND Subscriptions.channel_id = Channels.id AND Subscriptions.user_id = ?
                                ORDER BY date DESC LIMIT 5 OFFSET ?');
          break;
      case "top":
          $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                                FROM Posts, Users, Channels, Subscriptions
                                WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id  AND Subscriptions.channel_id = Channels.id AND Subscriptions.user_id = ?
                                ORDER BY votes DESC, date ASC LIMIT 5 OFFSET ?');
          break;
      case "controversial":
          $stmt = $db->prepare('SELECT p1.id, p1.title, p1.content, p1.link, p1.date, p1.votes, Users.username, Channels.name as channel, comments
                                FROM Posts p1, Users, Channels, Subscriptions, (
                                   SELECT p2.id as id_post, count(Comments.id) as comments FROM Posts p2, Comments WHERE Comments.post_id = p2.id GROUP BY p2.id
                                )
                                WHERE p1.user_id = Users.id AND p1.channel_id = Channels.id AND p1.id = id_post AND Subscriptions.channel_id = Channels.id AND Subscriptions.user_id = ?
                                ORDER BY comments DESC, votes DESC LIMIT 5 OFFSET ?');
          break;
    }

    $stmt->execute(array($user_id, $offset));
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

  /**
   * Searches the posts
   * @param  string $query what the user is searching for
   * @return array  posts that match the query
   */
  function searchPosts($query){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel
                          FROM Posts, Users, Channels
                          WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id AND (Posts.title LIKE ? OR Posts.content LIKE ? OR Posts.link LIKE ? OR Users.username LIKE ? OR Channels.name LIKE ?)
                          ORDER BY date DESC');
    $stmt->execute(array("%$query%", "%$query%", "%$query%", "%$query%", "%$query%"));
    return $stmt->fetchAll();
  }

  /**
   * Adds a text post to the database
   * @param  string $title      post title
   * @param  string $content    post content
   * @param  int    $user_id    id of the poster
   * @param  int    $channel_id id of the channel where the post is being posted
   * @return int    id of the post that was submitted
   */
  function addTextPost($title, $content, $user_id, $channel_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO Posts VALUES (NULL, ?, ?, NULL, ?, ?, ?, 0)');
    $stmt->execute(array($title, $content, time(), $user_id, $channel_id));
    return $db->lastInsertId();
  }

  /**
   * Adds a link post to the database
   * @param  string $title      post title
   * @param  string $link       post link
   * @param  int    $user_id    id of the poster
   * @param  int    $channel_id id of the channel where the post is being posted
   * @return int    id of the post that was submitted
   */
  function addLinkPost($title, $link, $user_id, $channel_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('INSERT INTO Posts VALUES (NULL, ?, NULL, ?, ?, ?, ?, 0)');
    $stmt->execute(array($title, $link, time(), $user_id, $channel_id));
    return $db->lastInsertId();
  }


  /**
   * Removes a post (post stays in DB and website, text is changed to [DELETED])
   * @param  int $post_id id of the post that is being removed
   */
  function deletePost($post_id){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Posts SET title = "[DELETED]" WHERE id = ?');
    $stmt->execute(array($post_id));

    $post = getPost($post_id);

    if($post['content'] == null){ //it's a link post
      $post_link = '/post.php/?id=' . $post_id;
      $stmt = $db->prepare('UPDATE Posts SET link = ? WHERE id = ?');
      $stmt->execute(array($post_link, $post_id));
    }
    else{//it's a text post
      
      $stmt = $db->prepare('UPDATE Posts SET content = "[DELETED]" WHERE id = ?');
      $stmt->execute(array($post_id));

    }



  }


   /**
   * edits a text post 
   * @param  int $post_id id of the post that is being edited
   * @param  string $title new post title
   * @param  string $content new post content
   */
  function editTextPost($post_id, $title, $content){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Posts SET title = ?, content = ? WHERE id = ?');
    $stmt->execute(array($title,$content,$post_id));
  }

  /**
   * edits a link post 
   * @param  int $post_id id of the post that is being edited
   * @param  string $title new post title
   * @param  string $link new post link
   */
  function editLinkPost($post_id, $title, $link){
    $db = Database::instance()->db();
    $stmt = $db->prepare('UPDATE Posts SET title = ?, link = ? WHERE id = ?');
    $stmt->execute(array($title,$link,$post_id));
  }

  function getPostOfUser($username){
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT Posts.id, Posts.title, Posts.content, Posts.link, Posts.date, Posts.votes, Users.username, Channels.name as channel FROM Posts, Users, Channels WHERE Posts.user_id = Users.id AND Posts.channel_id = Channels.id AND Users.username = ? ORDER BY date DESC	');
    $stmt->execute(array($username));
    return $stmt->fetchAll();
  }

?>
