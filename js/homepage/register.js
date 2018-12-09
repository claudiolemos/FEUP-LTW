let username = document.querySelector('#register-pop-up .container input[name=username]');
let email = document.querySelector('#register-pop-up .container input[name=email]');
let password = document.querySelector('#register-pop-up .container input[name=password]');
let confirm = document.querySelector('#register-pop-up .container input[name=confirm]');

if(username != null){
  username.addEventListener('keyup', function() {
    let request = createRequest("/../../actions/api_register.php", {type: "username", value: username.value});
    request.onreadystatechange=function(){updateIcons(request, username, "username");};
  });
}

if(email != null){
  email.addEventListener('keyup', function() {
    let request = createRequest("/../../actions/api_register.php", {type: "email", value: email.value});
    request.onreadystatechange=function(){updateIcons(request, email, "email");};
  });
}

if(password != null){
  password.addEventListener('keyup', function() {
    updatePasswordIcons();
  });
}

if(confirm != null){
  confirm.addEventListener('keyup', function() {
    updatePasswordIcons();
  });
}

function updatePasswordIcons(){
  if(confirm.value != password.value && confirm.value != ""){
    password.style.backgroundImage = "none";
    confirm.style.backgroundImage = "url('/../../images/warning.svg')";
    confirm.setCustomValidity("Passwords don't match");
  }
  else if(confirm.value == password.value){
    password.style.backgroundImage = "url('/../../images/check.svg')";
    confirm.style.backgroundImage = "url('/../../images/check.svg')";
    confirm.setCustomValidity("");
  }

  if(password.value == "" || confirm.value == ""){
    password.style.backgroundImage = "none";
    confirm.style.backgroundImage = "none";
  }
}

function updateIcons(request, input, string){
  if (request.readyState==4 && request.status==200 && input.value != ""){
    if(JSON.parse(request.responseText)){
      input.style.backgroundImage = "url('/../../images/warning.svg')";
      input.setCustomValidity("Invalid " + string);
    }
    else{
      input.style.backgroundImage = "url('/../../images/check.svg')";
      input.setCustomValidity("");
    }
  }
  else if(input.value == "")
    input.style.backgroundImage = "none";
}
