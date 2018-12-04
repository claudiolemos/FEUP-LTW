sortHot = document.querySelector('#sort li[name=hot]');
sortNew = document.querySelector('#sort li[name=new]');
sortTop = document.querySelector('#sort li[name=top]');


postUpvote = document.querySelectorAll('#posts article .upvote');
postDownvote = document.querySelectorAll('#posts article .downvote');

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

for(var i = 0; i < postUpvote.length; i++) {
  postUpvote[i].addEventListener('click', function(event) {
    event.preventDefault();
    this.parentNode.querySelector('span').innerHTML = this.value;
  })
}

for(var i = 0; i < postUpvote.length; i++) {
  postDownvote[i].addEventListener('click', function(event) {
    event.preventDefault();

    this.parentNode.querySelector('span').innerHTML = this.value;
  })
}

sortHot.addEventListener('click', function(event) {
  event.preventDefault();
});

sortNew.addEventListener('click', function(event) {
  event.preventDefault();
});

sortTop.addEventListener('click', function(event) {
  event.preventDefault();
});
