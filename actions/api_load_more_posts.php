<?php
  include_once(__DIR__."/../includes/init.php");
  include_once(__DIR__."/../database/posts.php");
  include_once(__DIR__."/../database/users.php");


  $username = $_SESSION['username'];
  $current_offset = $_POST['current_offset'];
  $current_sort = $_POST['current_sort'];
  $curr_channel = $_POST['curr_channel'];


  if($curr_channel!=null){


    $more_posts = getPosts($current_sort, $curr_channel, $current_offset);

    foreach($more_posts as $post => &$val){
      $upBtnClass = getVoteButtonClass(getUserID($_SESSION['username']), $val['id'], 1);
      $val['upBtnClass'] = $upBtnClass;

      $downBtnClass = getVoteButtonClass(getUserID($_SESSION['username']), $val['id'], -1);
      $val['downBtnClass'] = $downBtnClass;



      $val['thumbnail'] = getPostThumbnail($val['id']);

      $val['format_date'] = gmdate("Y-m-d", $val['date']);

      $val['numComments'] = getNoComments($val['id']);


    }
  }
  else{

    $more_posts = getPosts($current_sort, null, $current_offset);

    foreach($more_posts as $post => &$val){

      $upBtnClass = getVoteButtonClass(getUserID($_SESSION['username']), $val['id'], 1);
      $val['upBtnClass'] = $upBtnClass;

      $downBtnClass = getVoteButtonClass(getUserID($_SESSION['username']), $val['id'], -1);
      $val['downBtnClass'] = $downBtnClass;

      $val['thumbnail'] = getPostThumbnail($val['id']);

      $val['format_date'] = gmdate("Y-m-d", $val['date']);

      $val['numComments'] = getNoComments($val['id']);

    }

  }
  
  echo json_encode($more_posts);
  

?>
