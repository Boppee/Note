const controll = ({id}) => `
<div class="controllB" id="c${id}">
  <i class="fas fa-dot-circle"></i>
</div>
`;
const imgs = ({id, imgtype}) => `
<div class="imgsGal" id="i${id}" style="background-image: url(pages/news/imgs/${id}/start.${imgtype});">
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
        $("#i1").attr("visible", "true");
        curImg = 1;
      }
    }

    $("#imgGal").css("height", $("#imgGal").css("width").slice(0, -2)*0.55+"px");

    window.onresize = function() {
      $("#imgGal").css("height", $("#imgGal").css("width").slice(0, -2)*0.55+"px");
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
