<footer>
  <p style="cursor: pointer;" onclick="document.getElementById('about-pop-up').style.display='block'">About</p>
  Reddit &copy; 2018
  <div id="about-pop-up" class="pop-up">
    <form method="post" class="pop-up-content animate" action="/../actions/create_channel.php">
      <div class="close-button">
        <span onclick="document.getElementById('about-pop-up').style.display='none'" class="close">&times;</span>
      </div>
      <div class="container">
        <p style="margin-top: 20px; text-align: justify; color:black;">This project was developed for the Web Languages and Technologies class of the Master in Informatics and Computer Engineering at the Faculty of Engineering of the University of Porto by Cláudio Lemos, Duarte Faria and José Mendes in 2018.</p>
        <a href="https://sigarra.up.pt/feup/pt/fest_geral.cursos_list?pv_num_unico=201603542"><img src="https://imgur.com/P9GxWZL.jpg" style="width:75px; height:75px; margin:5px; border-radius:50%;"></a>
        <a href="https://sigarra.up.pt/feup/pt/fest_geral.cursos_list?pv_num_unico=201607176"><img src="duarte" style="width:75px; height:75px; margin:5px; border-radius:50%;"></a>
        <a href="https://sigarra.up.pt/feup/pt/fest_geral.cursos_list?pv_num_unico=201200647"><img src="jose" style="width:75px; height:75px; margin:5px; border-radius:50%;"></a>
      </div>
    </form>
  </div>
</footer>
</body>

<script src="/js/utils.js" defer></script>
<script src="/js/postVoting.js" defer></script>
<script src="/js/commentsVoting.js" defer></script>
<script src="/js/sort.js" defer></script>
<script src="/js/register.js" defer></script>
<script src="/js/login.js" defer></script>
<script src="/js/settings.js" defer></script>
<script src="/js/subscribe.js" defer></script>
<script src="/js/createChannel.js" defer></script>
</html>
