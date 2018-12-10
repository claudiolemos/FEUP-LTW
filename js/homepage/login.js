let form = document.querySelector('#login-pop-up form');
let loginInput = document.querySelectorAll('#login-pop-up .container input');
let loginUsername = document.querySelector('#login-pop-up .container input[name=username]');
let loginPassword = document.querySelector('#login-pop-up .container input[name=password]');

if(form != null){
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    let request = createRequest("/../../actions/api_login.php", {username: loginUsername.value, password: loginPassword.value});

    request.onreadystatechange=function(){
      if (request.readyState==4 && request.status==200){
        switch (JSON.parse(request.responseText)){
          case "valid":
            console.log(1);
            location.reload();
            break;
        }
      }
    }
  });
}

for(let i = 0; i < loginInput.length; i++){
  if(loginInput[i] != null){
    loginInput[i].addEventListener('keyup', function(event) {
      let request = createRequest("/../../actions/api_login.php", {username: loginUsername.value, password: loginPassword.value});

      request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
          switch (JSON.parse(request.responseText)) {
            case "valid":
              loginUsername.setCustomValidity("");
              loginPassword.setCustomValidity("");
              break;
            case "username":
              loginUsername.setCustomValidity("Username doesn't exist");
              loginPassword.setCustomValidity("");
              break;
            case "password":
              loginUsername.setCustomValidity("");
              loginPassword.setCustomValidity("Incorrect password");
              break;
          }
        }
      }
    });
  }
}
