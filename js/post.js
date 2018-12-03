
$(document.body).on('click', '.replyBtn' ,function(e){

    if ($('#replyDiv-'+this.value).length) {

        if ($('#replyDiv-'+this.value).is(":visible")) {
            $('#replyDiv-'+this.value).hide(1000);
        } else {
            $('#replyDiv-'+this.value).show(1000);
        }

    }
    else{


     $('#user-comment-'+this.value).append('<div class="row" id="replyDiv-'+this.value+'"><div class="col-md-6">'
        + '<div class="widget-area no-padding blank">'
        + '<div class="comment-upload-div">'
        + '<textarea placeholder="Type your comment here" id="commentBody-'+this.value+'" class="hey"></textarea>'
        + '<button type="submit" class="comment-upload btn btn-dark btn-edit" value="'+this.value+'"><i class="fa fa-share"></i> Comment</button>'
        + '</div></div></div></div>');                     
        
    }        
});