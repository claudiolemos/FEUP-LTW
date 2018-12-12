let sort = document.querySelectorAll('#sort li[name=new], #sort li[name=top], #sort li[name=controversial]');
let sortSubscriptions = document.querySelector('#sort li[name=subscribed]');
let postsNode = document.querySelector('#posts, #channel-posts');
let channelID = document.querySelector('#channel-id a') == null? null : document.querySelector('#channel-id a').innerHTML;

let currentSort = "new";
let sortSubscribed = false;

for(var i = 0; i < sort.length; i++) {
  sort[i].addEventListener('click', function(event) {
    event.preventDefault();
    currentSort = this.getAttribute("name");
    let request = channelID == null? createRequest("/../../actions/api_sort.php", {sort: currentSort, subscribed: sortSubscribed, username: username}) : createRequest("/../../actions/api_sort.php", {sort: currentSort, id: channelID});
    request.onreadystatechange=function(){updatePosts(request);}
  });
}

if(sortSubscriptions != null){
  sortSubscriptions.addEventListener('click', function(event) {
    event.preventDefault();
    sortSubscribed = !sortSubscribed;
    sortSubscriptions.style.backgroundColor = sortSubscribed? "var(--red2)" : "transparent";

    let request = createRequest("/../../actions/api_sort.php", {sort: currentSort, subscribed: sortSubscribed, username: username});
    request.onreadystatechange=function(){updatePosts(request);}

  });
}

function updatePosts(request){
  if (request.readyState==4 && request.status==200){
    let posts = JSON.parse(request.responseText);
    while(postsNode.firstChild)
      postsNode.removeChild(postsNode.firstChild);

    for(let i = 0; i < posts.length; i++)
      createArticle(posts[i], i);
  }
}

function createArticle(post){
  let article = document.createElement('article');
  article.id = post['id'];

  let request = createRequest("/../../actions/api_article.php", {id: post['id']});
  request.onreadystatechange=function(){
    if(request.readyState==4 && request.status==200){
      let response = JSON.parse(request.responseText);
      article.innerHTML = `<div class="voting"><button class="${response['upvote']}"></button><span class="votes">${response['votes']}</span><button class="${response['downvote']}"></button></div><div class="thumbnail"><img src="${response['thumbnail']}"></div><header><p class="title"><a href="/post.php/?id=${post['id']}">${response['title']}</a></p></header><footer><span class="date">${response['date']}</span><span class="username"><a href="/profile.php/?id=${response['username']}"> ${response['username']}</a></span><span class="channel"><a href="/channel.php/?id=${response['channel']}"> ${response['channel']}</a></span><span class="comments"> ${response['comments']}</span></footer>`;
      postsNode.append(article);
    }
  }
}
