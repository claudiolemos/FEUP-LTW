
$(document.body).on('click', '.replyBtn' ,function(e){

    if ($('#replyDiv-'+this.value).length) {

        if ($('#replyDiv-'+this.value).is(":visible")) {
            $('#replyDiv-'+this.value).hide(500);
        } else {
            $('#replyDiv-'+this.value).show(500);
        }

    }
    else{

        $('#user-comment-'+this.value).append('<div style="display:none" class="replyBox" id="replyDiv-'+this.value+'">'
            + '<textarea placeholder="Type your comment here" id="commentBody-'+this.value+'" class="hey"></textarea>'
            + '<button type="submit" class="comment-upload" value="'+this.value+'">Comment</button>'
            + '</div>');

        $('#replyDiv-'+this.value).show(500);                 
        
    }        
});