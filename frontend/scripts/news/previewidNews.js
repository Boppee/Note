$(document).ready(function () {

    const imgs = ({id, imgtype, name}) => `
    <div class="imgsGal" id="i${id}" style="background-image: url(pages/news/imgs/preview/${id}/${name}.${imgtype});">
    </div>
    `;

    $.ajax({
      type: "POST",
      url: "scripts/news/previewfetchIdNews.php",
      data: {id: id},
      success: function (data) {
        if (data[0].uniquepage == 0) {

          for (var i = 0; i < data[0].imgs.length; i++) {
            $("#imgGal").append([{id: id, imgtype: data[0].imgs[i].t, name: data[0].imgs[i].n}].map(imgs).join(''));
          }

          margin = 10;

          resize();

          window.addEventListener('resize', resize, false);

          function resize() {
            margin = 10;
            $("#imgGal").css("height", (margin*2)+($("#imgGal").css("width").slice(0, -2)/21)*9+"px");
            $(".imgsGal").css("height", margin+($("#imgGal").css("width").slice(0, -2)/21)*9+"px");
            $(".imgsGal").css("margin", margin+"px 0px");
          }

          $("#newsName span").text(data[0].name);
          $("#newsDesc span").text(data[0].description);
          if (data[0].link) {

          }
        }else {

        }
      }
    });

});
