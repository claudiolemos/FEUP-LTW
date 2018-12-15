<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/users.php");
  include_once(__DIR__."/../database/channels.php");


  $content = $_POST['content'];


  //check for user mentions
  //check if comment mentions a user. - regex: \/u\/[^\s]+   ex: /u/ze 
  $regexUsers = '/@[^\s]+/';
  $regexChannels = '/#[^\s]+/';
  $result = "";

  $output_array_channels;
  preg_match_all($regexChannels, $content, $output_array_channels);

  $output_array_users;
  preg_match_all($regexUsers, $content, $output_array_users);


  //search for usernames in content
  foreach ($output_array_users[0] as $users) {
    $username = "";
    $username = str_replace("@", "", $users);

    //get userID from username
    $userID = getUserID($username);

    if($userID!=-1){//if user exists

      $userHTML = '<a href="/profile.php/?id='.$username.'">#'.$username.'</a>'; 

      //replace username with link to users page in content
      $search = '@'.$username;
      $content = str_replace($search, $userHTML, $content);

    }

    
  }

  //search for channels in content
  foreach ($output_array_channels[0] as $channels) {
    $channelName = "";
    $channelName = str_replace("#", "", $channels);

    //get channelID from channelName
    $channelID = getChannelID($channelName);

    if($channelID!= -1){ //if channel exists
      $channelHTML = '<a href="/channel.php/?id='.$channelID.'">@'.$channelName.'</a>'; 

      //replace channelName with link to channel page in content
      $search = '#'.$channelName;
      $content = str_replace($search, $channelHTML, $content);

    }

    

  }



  echo json_encode($content);
  

?>