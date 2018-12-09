// let submit = document.querySelector('#login-pop-up .container button[type=submit]');
//
// if(submit != null){
//   submit.addEventListener('click', function(event) {
//     let username = document.querySelector('#login-pop-up .container input[name=username]');
//     let password = document.querySelector('#login-pop-up .container input[name=password]');
//     let request = createRequest(username.value, password.value);
//     event.preventDefault();
//
//     request.onreadystatechange=function(){
//
//       if (request.readyState==4 && request.status==200){
//         switch (JSON.parse(request.responseText)) {
//           case "valid":
//             this.unbind('click').click();
//           case "username":
//             username.setCustomValidity("Username doesn't exist");
//             break;
//           case "password":
//             password.setCustomValidity("Incorrect password");
//             break;
//         }
//       }
//     }
//   });
// }
//
// function createRequest(username, password){
//   let request = new XMLHttpRequest();
//   request.open("post", "/../../actions/api_login.php", true);
//   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   request.send(encodeForAjax({username: username, password: password}));
//   return request
// }
