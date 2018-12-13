let registerUsername = document.querySelector('#register-pop-up .container input[name=username]');
let registerEmail = document.querySelector('#register-pop-up .container input[name=email]');
let registerPassword = document.querySelector('#register-pop-up .container input[name=password]');
let confirmPassword = document.querySelector('#register-pop-up .container input[name=confirm]');

if(registerUsername != null){
  registerUsername.addEventListener('change', function() {
    let request = createRequest("/../../actions/api_register.php", {type: "username", value: registerUsername.value});
    request.onreadystatechange=function(){updateLoginIcons(request, registerUsername, "username");};
  });
}

if(registerEmail != null){
  registerEmail.addEventListener('change', function() {
    let request = createRequest("/../../actions/api_register.php", {type: "email", value: registerEmail.value});
    request.onreadystatechange=function(){updateLoginIcons(request, registerEmail, "email");};
  });
}

if(registerPassword != null){
  registerPassword.addEventListener('change', function() {
    updatePasswordIcons();
  });
}

if(confirmPassword != null){
  confirmPassword.addEventListener('change', function() {
    updatePasswordIcons();
  });
}

function updatePasswordIcons(){
  if(confirmPassword.value != registerPassword.value && confirmPassword.value != ""){
    registerPassword.style.backgroundImage = "none";
    confirmPassword.style.backgroundImage = "url('/../../images/warning.svg')";
    confirmPassword.setCustomValidity("Passwords don't match");
  }
  else if(confirmPassword.value == registerPassword.value){
    registerPassword.style.backgroundImage = "url('/../../images/check.svg')";
    confirmPassword.style.backgroundImage = "url('/../../images/check.svg')";
    confirmPassword.setCustomValidity("");
  }

  if(registerPassword.value == "" || confirmPassword.value == ""){
    registerPassword.style.backgroundImage = "none";
    confirmPassword.style.backgroundImage = "none";
  }
}

function updateLoginIcons(request, input, string){
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
