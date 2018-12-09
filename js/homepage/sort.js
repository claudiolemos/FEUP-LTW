let sort = document.querySelectorAll('#sort li');
let posts = document.querySelector('#posts');

for(var i = 0; i < sort.length; i++) {
  sort[i].addEventListener('click', function(event) {
    event.preventDefault();
    let request = createRequest(this.getAttribute("name"));

    request.onreadystatechange=function(){
      if (request.readyState==4 && request.status==200){
        console.log(JSON.parse(request.responseText));
      }
    }
  });
}

function createRequest(sort){
  let request = new XMLHttpRequest();
  request.open("post", "/../../actions/api_sort.php", true);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.send(encodeForAjax({sort: sort}));
  return request;
}
