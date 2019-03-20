const controll = ({id}) => `
<div class="controllB" id="c${id}">
  <i class="fas fa-dot-circle"></i>
</div>
`;
const imgs = ({id, imgtype, imgid}) => `
<div class="imgsGal" id="i${id}" value="${imgid}" style="background-image: url(pages/news/imgs/${imgid}/start.${imgtype});">
</div>
`;

$.ajax({
  type: "GET",
  url: "scripts/news/fetchNews.php",
  success: function (news) {

    maxImg = news.length;

    for (var i = 0; i < news.length; i++) {
      $("#innercontroll").append([{id: i}].map(controll).join(''));
      $("#imgGal").append([{id: i, imgid: news[i].id, imgtype: news[i].imgs[0].t}].map(imgs).join(''));
      if (i >= 1) {
        $("#i"+i).hide();
      }else {
        $("#c0 i").toggleClass("fa-dot-circle fa-circle");
        $("#i0").attr("visible", "true");
        curImg = 0;
      }
    }

    $("#imgGal").css("height", ($("#imgGal").css("width").slice(0, -2)/21)*9+"px");

    window.onresize = function() {
      $("#imgGal").css("height", ($("#imgGal").css("width").slice(0, -2)/21)*9+"px");
    };

    pause = false;

    $(".controllB").click(function () {

      if ($(this).attr("id") != "c"+curImg) {

        $(".imgsGal[visible='true']").hide().attr("visible", "false");

        $("#i"+$(this).attr("id").substr(1)).slideDown().attr("visible", "true").show();

        $(".controllB i").addClass("fa-dot-circle");
        $(".controllB i").removeClass("fa-circle");
        $("#c"+$(this).attr("id").substr(1)+" i").toggleClass("fa-dot-circle fa-circle");

        curImg = $(this).attr("id").substr(1);

        pause = true;
      }

    });

    $(".imgsGal").click(function () {
      window.location.href = "?page=news&id="+$(this).attr("value");
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

        $(".imgsGal[visible='true']").slideToggle().attr("visible", "false");

        $("#i"+curImg).prependTo("#imgGal").slideToggle().attr("visible", "true").show();

        $(".controllB i").addClass("fa-dot-circle");
        $(".controllB i").removeClass("fa-circle");
        $("#c"+curImg+" i").toggleClass("fa-dot-circle fa-circle");

      }else {
        temp++;
        if (temp == 2) {
          pause = false;
          temp = 0;
        }
      }
    }, 7500);
  }
});
