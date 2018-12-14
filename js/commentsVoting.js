let commentUpvote = document.querySelectorAll('#posts #comments .user-comment .upvote, #posts #comments .user-comment .upvoted');
let commentDownvote = document.querySelectorAll('#posts #comments .user-comment .downvote, #posts #comments .user-comment .downvoted');

if(username != null){
  for(var i = 0; i < commentUpvote.length; i++) {
    commentUpvote[i].addEventListener('click', function(event) {


      event.preventDefault();
      let comment_id = this.parentNode.parentNode.id.replace("user-comment-", "");

      let request = new XMLHttpRequest();
      request.open("post", "/../actions/api_comment_voting.php", true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(encodeForAjax({comment_id: comment_id, vote: 1}));

      let upvoteClass = this.className;
      let downvoteClass = this.parentNode.querySelector('span + button').className;
      let votes = parseInt(this.parentNode.querySelector('span').innerHTML);

      if(upvoteClass == "upvote" && downvoteClass == "downvote"){
        this.parentNode.querySelector('span').innerHTML = votes + 1;
        this.className = "upvoted";
      }
      else if(upvoteClass == "upvoted" && downvoteClass == "downvote"){
        this.parentNode.querySelector('span').innerHTML = votes - 1;
        this.className = "upvote";
      }
      else if(upvoteClass == "upvote" && downvoteClass == "downvoted"){
        this.parentNode.querySelector('span').innerHTML = votes + 2;
        this.className = "upvoted";
        this.parentNode.querySelector('span + button').className = "downvote"
      }

    })
  }

  for(var i = 0; i < commentDownvote.length; i++) {
    commentDownvote[i].addEventListener('click', function(event) {
      event.preventDefault();
      let comment_id = this.parentNode.parentNode.id.replace("user-comment-", "");

      let request = new XMLHttpRequest();
      request.open("post", "/../actions/api_comment_voting.php", true);
      request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      request.send(encodeForAjax({comment_id: comment_id, vote: -1}));

      let upvoteClass = this.parentNode.querySelector('button').className;
      let downvoteClass = this.className;
      let votes = parseInt(this.parentNode.querySelector('span').innerHTML);

      if(upvoteClass == "upvote" && downvoteClass == "downvote"){
        this.parentNode.querySelector('span').innerHTML = votes - 1;
        this.className = "downvoted";
      }
      else if(upvoteClass == "upvote" && downvoteClass == "downvoted"){
        this.parentNode.querySelector('span').innerHTML = votes + 1;
        this.className = "downvote";
      }
      else if(upvoteClass == "upvoted" && downvoteClass == "downvote"){
        this.parentNode.querySelector('span').innerHTML = votes - 2;
        this.className = "downvoted";
        this.parentNode.querySelector('button').className = "upvote"
      }

    })
  }
}
else{
  for(var i = 0; i < commentUpvote.length; i++)
    commentUpvote[i].onclick = function() { document.getElementById('register-pop-up').style.display='block';};


  for(var i = 0; i < commentDownvote.length; i++)
    commentDownvote[i].onclick = function() { document.getElementById('register-pop-up').style.display='block';};
}
