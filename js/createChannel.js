let channelName = document.querySelector('#create-channel-pop-up .container input[name=name]');

if(channelName != null){
  channelName.addEventListener('change', function() {
    let request = createRequest("/../../actions/api_create_channel.php", {name: channelName.value});
    request.onreadystatechange=function(){updateChannelIcons(request);};
  });
}

function updateChannelIcons(request){
  if (request.readyState==4 && request.status==200 && channelName.value != ""){
    if(JSON.parse(request.responseText) == "valid"){
      channelName.style.backgroundImage = "url('/../../images/check.svg')";
      channelName.setCustomValidity("");
    }
    else{
      channelName.style.backgroundImage = "url('/../../images/warning.svg')";
      channelName.setCustomValidity("Invalid channel");
    }
  }
  else if(channelName.value == "")
    channelName.style.backgroundImage = "none";
}
