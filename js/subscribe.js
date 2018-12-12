let subscription = document.querySelector('.subscription button');

if(subscription != null){
  subscription.addEventListener('click', function(event) {
    let request = createRequest("/../actions/api_subscribe.php", {username: username, channel: channelID});
    request.onreadystatechange=function(){
      if (request.readyState==4 && request.status==200)
        subscription.innerHTML = JSON.parse(request.responseText);
    }
  });
}
