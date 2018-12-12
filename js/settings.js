let currentPassword = document.querySelector('#update_settings input[name=curr_pwd]');

console.log(currentPassword.value);

currentPassword.addEventListener('keyup', function(event) {
  let request = createRequest("../actions/api_settings.php", {password: currentPassword.value});
  console.log(currentPassword.value);

  request.onreadystatechange=function(){
    if (request.readyState==4 && request.status==200){
      switch (JSON.parse(request.responseText)) {
        case "valid":
          console.log("Valid!");
          break;
        case "password":
          console.log("Incorrect Password!");
          break;
      }
    }
  }
});
