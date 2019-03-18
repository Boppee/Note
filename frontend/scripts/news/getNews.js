const controll = ({id}) => `
<div class="controllB" id="c${id}">
  <i class="fas fa-dot-circle"></i>
</div>
`;
const imgs = ({id, imgtype}) => `
<div class="imgsGal" id="i${id}">
  <a href="?page=news&id=${id}"><img src="pages/news/imgs/${id}/start.${imgtype}" alt=""></a>
</div>
`;

$.ajax({
  type: "GET",
  url: "scripts/news/fetchNews.php",
  success: function (news) {

    maxImg = news.length;

    for (var i = 0; i < news.length; i++) {
      $("#innercontroll").append([{id: news[i].id}].map(controll).join(''));
      $("#imgGal").append([{id: news[i].id, imgtype: news[i].imgs[0].t}].map(imgs).join(''));
      if (i >= 1) {
        $("#i"+news[i].id).hide();
      }else {
        $("#c1 i").toggleClass("fa-dot-circle fa-circle");
        curImg = 1;
      }
    }

    pause = false;

    $(".controllB").click(function () {

      if ($(this).attr("id") != "c"+curImg) {
        $("#i"+curImg+", #i"+$(this).attr("id").substr(1)).slideToggle();

        $(".controllB i").addClass("fa-dot-circle");
        $(".controllB i").removeClass("fa-circle");
        $("#c"+$(this).attr("id").substr(1)+" i").toggleClass("fa-dot-circle fa-circle");

        curImg = $(this).attr("id").substr(1);

        pause = true;
      }

    });

    temp = 0;

    backw = false;

    window.setInterval(function(){
      if (pause == false) {
        if (maxImg <= curImg) {
          backw = true;
        }
        if (curImg == 1) {
          backw = false;
        }

        if (backw == true) {
          curImg--;
        }else {
          curImg++;
        }

        $(".controllB i").addClass("fa-dot-circle");
        $(".controllB i").removeClass("fa-circle");
        $("#c"+curImg+" i").toggleClass("fa-dot-circle fa-circle");

        $(".imgsGal").slideUp();

        $("#i"+curImg).slideDown("");

      }else {
        temp++;
        if (temp == 2) {
          pause = false;
          temp = 0;
        }
      }
    }, 5000);
  }
});
