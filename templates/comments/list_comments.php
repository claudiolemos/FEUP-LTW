


<section id="comments">
<?php foreach ($parent_comments as $comment) {



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
      echo '</div>';

    getChildComments($comment['id']);

    echo "</div>";
  }

?>

</section>