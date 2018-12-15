


let commentInputHtml = '<div style="display:none" class="comment-input-div" id="top-comment-div">'
            +'<textarea placeholder="Type your reply here" rows="20" name="comment"'
            + 'id="textarea-id" '
            + 'cols="40" class="comment-input" role="textbox"'
            +'</textarea>';


$(document.body).on('click', '.write-comment' ,function(e){



	if ($('#replyDiv-' + this.value).length) {

        if ($('#replyDiv-' + this.value).is(":visible")) {
            $('#replyDiv-' + this.value).hide(300);
        } else {
            $('#replyDiv-' + this.value).show(300);
        }

    }
    else{


        let replyHtml = commentInputHtml.replace("top-comment-div", "replyDiv-" + this.value);
        replyHtml = replyHtml.replace('textarea-id', "comment-input-" + this.value);



    	$('#write-top-level-comment-div').after(replyHtml);



    	$('#replyDiv-' + this.value).append('<button class="post-comment-btn" value="'+ this.value +'" >Post Comment</button>');

    	$('#replyDiv-' + this.value).show(300);   

    }

    


});

function encodeForAjax(data) {

  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}


$(document.body).on('click', '.post-comment-btn' ,function(e){


	let comment = $('#comment-input-'+this.value).val();


	if(comment == "" || comment == undefined){
		alert("cannot post empty comments!");
	}
	else{

        $('#comment-input-'+this.value).val('');
		$('#replyDiv-'+this.value).hide(300);


        let post_comment_parent = this.value.split("-");


		let post_id = post_comment_parent[0];
        let parent_id = post_comment_parent[1]; //level comment, so parent_id is null

        let checkmentions = new XMLHttpRequest();
        checkmentions.open("post", "/../actions/api_check_mentions.php", true); 
        checkmentions.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        checkmentions.send(encodeForAjax({content: comment}));

        checkmentions.onreadystatechange = function () {
            if(checkmentions.readyState === 4 && checkmentions.status === 200) {

                comment = JSON.parse(this.responseText);

                let request = new XMLHttpRequest();
                request.open("post", "/../actions/api_post_comment.php", true); 
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        
                request.send(encodeForAjax({post_id: post_id, content: comment, parent_id: parent_id}));
       

                request.onreadystatechange = function () {
                    if(request.readyState === 4 && request.status === 200) {


                        if(this.responseText!=""){


                            let newID = JSON.parse(this.responseText)["comment_id"];
                            let post_id = JSON.parse(this.responseText)["post_id"];
                            let parent_id = JSON.parse(this.responseText)["parent_id"];
                            let user_id = JSON.parse(this.responseText)["user_id"];
                            let date = JSON.parse(this.responseText)["date"];

                            let newComment = "<div style='display:none' class="+"user-comment"+" id="+"user-comment-"+newID+">"
                                + "<div class='voting comment-voting'>"
                                + "<button class='upvoted'></button>"
                                + "<span class='votes comment-votes'>"+'1'+"</span>" 
                                + "<button class="+'downvote'+"></button>"
                                + "</div>"
                                + "<span id="+"comment-info"+">"+ user_id + " - " + date +"</span>"
                                + "<div class="+'comment-body'+">"+ comment + "</div>"
                                + '<div class="write-comment-div" id="write-comment-div-'+ newID +'">'
                                + "<button type="+'submit'+" class="+'replyBtn'+" value="+ post_id +"-"+ newID +"-"+ parent_id +">"+ 'Reply' + "</button>"
                                + '</div>'
                                + "</div>";

                            if(parent_id == null){

                                $('#comments').prepend(newComment);
                            }

                            else{
                                $('#write-comment-div-' + parent_id).after(newComment);
                            }

                

                            $('#user-comment-' + newID).show(300); 

                        }
                        else{
                            alert("log in to post comments!");
                        } 


                        comment ="";

                    }
                };
                
                        
            }


        };





	}


});



$(document.body).on('click', '.replyBtn' ,function(e){


    let post_comment_parent = this.value.split("-");
    let commentID = post_comment_parent[1];



    if ($('#replyDiv-'+this.value).length) {

        if ($('#replyDiv-'+this.value).is(":visible")) {
            $('#replyDiv-'+this.value).hide(300);
        } else {
            $('#replyDiv-'+this.value).show(300);
        }

    }
    else{


        let replyHtml = commentInputHtml.replace("top-comment-div", "replyDiv-" + this.value);
        replyHtml = replyHtml.replace('textarea-id', "comment-input-" + this.value);


        $('#write-comment-div-'+commentID).append(replyHtml);

        $('#replyDiv-'+this.value).append('<button class="post-comment-btn" value="'+ this.value +'" >Post Comment</button>');


        $('#replyDiv-'+this.value).show(300);                 
        
    }        
});



$(document.body).on('click', '.comment-trashcan' ,function(e){

    var commentID = this.id.replace("user-delete-","");

    
    let request = new XMLHttpRequest();
    request.open("post", "/../actions/api_delete_comment.php", true); 
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.send(encodeForAjax({comment_id: commentID}));

    request.onreadystatechange = function () {

        if(request.readyState === 4 && request.status === 200) {
            $('#user-comment-'+commentID+'>.comment-body').replaceWith("<div class="+'comment-body'+">[DELETED]</div>");  
        }


    };



         
});


$(document.body).on('click', '.post-trashcan' ,function(e){

    var postID = this.id.replace("post-delete-","");

    
    let request = new XMLHttpRequest();
    request.open("post", "/../actions/api_delete_post.php", true); 
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.send(encodeForAjax({post_id: postID}));

    request.onreadystatechange = function () {

        if(request.readyState === 4 && request.status === 200) {
            $(".title>a").replaceWith('<a href="/post.php/?id="'+postID+'>[DELETED]</a>');
        }


    };



         
});



