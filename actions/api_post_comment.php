<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/comments.php");


  $username = $_SESSION['username'];
  $post_id = $_POST['post_id'];
  $content = $_POST['content'];
  $parent_id = $_POST['parent_id'];
  $date = time(); //TODO FORMAT



  if(isset($username)){
    //$user_id = getUserID($username);
    $user_id = "3"; //TODO: delete after merge, use getUserID instead

    //check for user mentions
    //check if comment mentions a user. - regex: \/u\/[^\s]+   ex: /u/ze 
    $regex = '/\/u\/[^\s]+/';
    $test = $content;
    //preg_match($regex, $test, $matches);
    //var_dump($matches);

    $newComment = addComment($content, $user_id, $post_id, $date, $parent_id);
    echo json_encode($newComment);
  }

?>