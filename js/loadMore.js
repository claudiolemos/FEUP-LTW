$(document.body).on('click', '#load-more-posts' ,function(e){

    var current_offset = $("#curr_offset").val();
    var current_sort = $("#curr_sort").val();
    let request = new XMLHttpRequest();
    request.open("post", "/../actions/api_load_more_posts.php", true); 
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    if($("#curr_channel").length){
        var curr_channel = $("#curr_channel").val(); 
        request.send(encodeForAjax({current_offset: current_offset, current_sort: current_sort, curr_channel: curr_channel}));
    }
    else{
        request.send(encodeForAjax({current_offset: current_offset, current_sort: current_sort}));
    }

    
    

    request.onreadystatechange = function () {

        if(request.readyState === 4 && request.status === 200) {

            for (var i = JSON.parse(this.responseText).length - 1; i >= 0; i--) {
                let post_id = JSON.parse(this.responseText)[i]["id"];
                let title = JSON.parse(this.responseText)[i]["title"];
                let content = JSON.parse(this.responseText)[i]["content"];
                let link = JSON.parse(this.responseText)[i]["link"];
                let date = JSON.parse(this.responseText)[i]["format_date"];
                let votes = JSON.parse(this.responseText)[i]["votes"];
                let username = JSON.parse(this.responseText)[i]["username"];
                let channel = JSON.parse(this.responseText)[i]["channel"];
                let upBtn = JSON.parse(this.responseText)[i]["upBtnClass"];
                let downBtn = JSON.parse(this.responseText)[i]["downBtnClass"];
                let thumbnail = JSON.parse(this.responseText)[i]["thumbnail"];
                let numComments = JSON.parse(this.responseText)[i]["numComments"];


                let html = '<article id="'+post_id+'">'
                +'<div class="voting">'
                + '<button class="'+upBtn+'"></button>'
                + '<span class="votes">'+votes+'</span>'
                + '<button class="'+downBtn+'"></button>'
                + '</div>'
                + '<div class="thumbnail">'
                + '<img src="'+thumbnail+'">'
                + '</div>'
                + '<header>'
                + '<p class="title"><a href="/post.php/?id='+post_id+'">'+title+'</a></p>'
                + '</header>'
                + '<footer>'
                + '<span class="date">'+date+'</span>'
                + '<span class="username"><a href="/profile.php/?id='+username+'">'+username+'</a></span>'
                + '<span class="channel"><a href="/channel.php/?id='+channel+'">'+channel+'</a></span>'
                + '<span class="comments">'+numComments+'</span>'
                + '</footer>'
                + '</article>';

                $('#load-more-posts').before(html);

                $("#curr_offset").val(parseInt(current_offset) + 5);


                updateVotingButtons();




            }

            
            

        }


    };



         
});
