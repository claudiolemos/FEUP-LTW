


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
                            let user_profile = JSON.parse(this.responseText)["user_profile"];
                            let date = JSON.parse(this.responseText)["date"];

                            let newComment = "<div style='display:none' class="+"user-comment"+" id="+"user-comment-"+newID+">"
                                + "<div class='voting comment-voting'>"
                                + "<button class='upvoted'></button>"
                                + "<span class='votes comment-votes'>"+'1'+"</span>" 
                                + "<button class="+'downvote'+"></button>"
                                + "</div>"
                                + "<span id="+"comment-info"+">"+ user_profile + " - " + date + " - "
                                + "<img id='user-edit-"+newID+"' class='comment-edit' src='/images/edit.png'>"
                                + "<img id='user-delete-"+newID+"' class='comment-trashcan' src='/images/garbage.png'>"
                                +  "</span>"
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

$(document.body).on('click', '.comment-edit' ,function(e){

    var commentID = this.id.replace("user-edit-","");


    if ($('#replyDiv-' + commentID).length) {

        if ($('#replyDiv-' + commentID).is(":visible")) {
            $('#replyDiv-' + commentID).hide(300);
            $('#user-comment-'+commentID+'>.comment-body').show(300);
        } else {
            $('#replyDiv-' + commentID).show(300);
            $('#user-comment-'+commentID+'>.comment-body').hide(300);
        }

    }

    else{
        let commentText = $('#user-comment-'+commentID+'>.comment-body').text();


        let replyHtml = commentInputHtml.replace("top-comment-div", "replyDiv-" + commentID);
        replyHtml = replyHtml.replace('textarea-id', "comment-input-" + commentID);
        replyHtml = replyHtml.replace('placeholder="Type your reply here"', 'placeholder=""');


        $('#user-comment-'+commentID+'>.comment-body').hide(300);

        $('#user-comment-'+commentID+'>.comment-body').after(replyHtml);


    
        $('#comment-input-'+commentID).text(commentText);



        $('#replyDiv-'+commentID).append('<button class="edit-comment-btn" value="'+ commentID +'" >Edit Comment</button>');
        $('#replyDiv-' + commentID).show(300);
    }


         
});


$(document.body).on('click', '.edit-comment-btn' ,function(e){

    let comment_id = this.value;

    let comment = $('#comment-input-'+comment_id).val();


    if(comment == "" || comment == undefined){
        alert("cannot post empty comments!");
    }
    else{

        let request = new XMLHttpRequest();
        request.open("post", "/../actions/api_edit_comment.php", true); 
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        request.send(encodeForAjax({comment: comment, comment_id: comment_id}));

        request.onreadystatechange = function () {

            if(request.readyState === 4 && request.status === 200) {

                $('#replyDiv-'+comment_id).hide(300);
                $('#replyDiv-'+comment_id).remove();

                $('#user-comment-'+comment_id+'>.comment-body').text(comment);
                $('#user-comment-'+comment_id+'>.comment-body').show(300);


            }


        };

    }
       
});


$(document.body).on('click', '.post-trashcan' ,function(e){

    var postID = this.id.replace("post-delete-","");

    
    let request = new XMLHttpRequest();
    request.open("post", "/../actions/api_delete_post.php", true); 
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.send(encodeForAjax({post_id: postID}));

    request.onreadystatechange = function () {

        if(request.readyState === 4 && request.status === 200) {
            $(".title>a").replaceWith('<a href="/post.php/?id='+postID+'">[DELETED]</a>');
            $(".content").text("[DELETED]");
        }


    };



         
});

$(document.body).on('click', '.post-edit' ,function(e){

    var post_id = this.id.replace("post-edit-","");

    

        



    if ($('.content').length) { //this means it is a text post

        let titleText = $(".title>a").text();
        let contentText = $('.content').text();

        if($("#edit-text-post-pop-up").length){
            $("#edit-title").val(titleText);
            $("#edit-content").val(contentText);

            $("#edit-text-post-pop-up").css('display', 'block');


        }
        else{
            let editTextPopUp = '<div id="edit-text-post-pop-up" class="pop-up" style="display: block;">'
                + '<form method="post" class="pop-up-content animate" action="/../actions/api_edit_text_post.php">'
                +  '<div class="close-button">'
                +    '<span onclick="document.getElementById('+"'edit-text-post-pop-up'"+').style.display='+"'none'"+'" class="close">×</span>'
                + '</div>'
                + '<div class="container">'
                +   '<label><a>Title</a></label>'
                +   '<input type="text" id="edit-title" name="title" placeholder="Title" required="" value="'+titleText+'">'
                +   '<label><a>Content</a></label>'
                +   '<input type="textarea" id="edit-content" name="content" placeholder="Content" required="" value="'+contentText+'">'
                +   '<input type="hidden" name="post_id" value="'+post_id+'">'
                +   '<button id="edit-text-post-btn" type="submit">Edit post</button>'
                + '</div>'
                + '</form>'
                +'</div>'

       

            $('#post-delete-'+post_id).after(editTextPopUp);
        }

        
        
    }

    else{ //link post

        let titleText = $(".title>a").text();
        let link = $(".title>a").attr('href');

        if($("#edit-link-post-pop-up").length){

            $("#edit-title").val(titleText);
            $("#edit-link").val(link);

            $("#edit-link-post-pop-up").css('display', 'block');

        }
        else{

            let editLinkPopUp = '<div id="edit-link-post-pop-up" class="pop-up" style="display: block;">'
                + '<form method="post" class="pop-up-content animate" action="/../actions/api_edit_link_post.php">'
                + '<div class="close-button">'
                + '<span onclick="document.getElementById('+"'edit-link-post-pop-up'"+').style.display='+"'none'"+'" class="close">×</span>'
                + '</div>'
                + '<div class="container">'
                + '<label><a>Title</a></label>'
                +  '<input type="text" id="edit-title" name="title" placeholder="Title" required="" value="'+titleText+'">'
                +  '<label><a>Link</a></label>'
                +  '<input type="url" id="edit-link" name="link" placeholder="https://example.com" required="" value="'+link+'">'
                +  '<input type="hidden" id="edit-link-post-id" value="'+post_id+'">'
                +  '<button id="edit-link-post-btn" type="submit">Edit post</button>'
                +   '</div>'
                +   '</form>'
                +   '</div>';

            $('#post-delete-'+post_id).after(editLinkPopUp);

        }
        
        
    }


  


         
});



